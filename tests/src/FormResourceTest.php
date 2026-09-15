<?php

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormResource;
use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormResource\Pages\EditForm;
use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormResource\Pages\ListForms;
use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormResource\RelationManagers\FormFieldsRelation;
use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormResource\RelationManagers\FormRequestsRelation;
use TomatoPHP\FilamentFormBuilder\Models\Form;
use TomatoPHP\FilamentFormBuilder\Models\FormRequest;
use TomatoPHP\FilamentFormBuilder\Services\FilamentCMSFormBuilder;
use TomatoPHP\FilamentFormBuilder\Tests\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

function makeForm(array $attributes = []): Form
{
    return Form::query()->create(array_merge([
        'type' => 'page',
        'title' => ['en' => 'Contact us'],
        'key' => 'contact-us',
        'endpoint' => '/',
        'method' => 'POST',
        'is_active' => true,
    ], $attributes));
}

beforeEach(function () {
    actingAs(User::factory()->create());
});

it('renders the list page over HTTP', function () {
    makeForm();

    $this->get(FormResource::getUrl('index'))->assertSuccessful();
});

it('lists forms', function () {
    $form = makeForm();

    livewire(ListForms::class)
        ->assertSuccessful()
        ->assertCanSeeTableRecords([$form]);
});

it('creates a form from the list page', function () {
    livewire(ListForms::class)
        ->callAction('create', data: [
            'type' => 'modal',
            'method' => 'POST',
            'title' => 'Newsletter',
            'key' => 'newsletter',
            'endpoint' => '/subscribe',
            'is_active' => true,
        ])
        ->assertHasNoActionErrors();

    $form = Form::query()->where('key', 'newsletter')->first();

    expect($form)->not->toBeNull()
        ->and($form->type)->toBe('modal')
        ->and($form->getTranslation('title', 'en'))->toBe('Newsletter');
});

it('renders and saves the edit page', function () {
    $form = makeForm();

    livewire(EditForm::class, ['record' => $form->getRouteKey()])
        ->assertSuccessful()
        ->fillForm(['endpoint' => '/contact'])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($form->refresh()->endpoint)->toBe('/contact');

    $this->get(FormResource::getUrl('edit', ['record' => $form]))->assertSuccessful();
});

it('adds a field from the fields relation manager', function () {
    $form = makeForm();

    livewire(FormFieldsRelation::class, ['ownerRecord' => $form, 'pageClass' => EditForm::class])
        ->assertSuccessful()
        ->callTableAction('create', data: [
            'type' => 'text',
            'name' => 'Full Name',
            'is_required' => true,
        ])
        ->assertHasNoTableActionErrors();

    $field = $form->fields()->first();

    expect($field)->not->toBeNull()
        ->and($field->name)->toBe('full_name')
        ->and($field->is_required)->toBeTrue();
});

it('builds a Filament schema from the stored fields and stores a submitted request', function () {
    $form = makeForm();
    $form->fields()->create(['type' => 'email', 'name' => 'email', 'is_required' => true, 'order' => 1]);
    $form->fields()->create(['type' => 'textarea', 'name' => 'message', 'order' => 2]);

    $schema = FilamentCMSFormBuilder::make('contact-us')->build();

    expect($schema)->toHaveCount(2)
        ->and($schema[0])->toBeInstanceOf(TextInput::class)
        ->and($schema[0]->getName())->toBe('email')
        ->and($schema[1])->toBeInstanceOf(Textarea::class);

    FilamentCMSFormBuilder::make('contact-us')->send(['email' => 'demo@example.com', 'message' => 'Hello']);

    expect(FormRequest::query()->where('form_id', $form->id)->first()->payload)
        ->toBe(['email' => 'demo@example.com', 'message' => 'Hello']);
});

it('ships a form factory for seeding demo data', function () {
    $form = Form::factory()->create(['title' => ['en' => 'Feedback']]);

    expect($form->getTranslation('title', 'en'))->toBe('Feedback')
        ->and($form->key)->not->toBeEmpty();

    $this->get(FormResource::getUrl('edit', ['record' => $form]))->assertSuccessful();
});

it('lists requests in the requests relation manager', function () {
    $form = makeForm();
    $request = $form->requests()->create(['status' => 'pending', 'payload' => ['email' => 'demo@example.com']]);

    livewire(FormRequestsRelation::class, ['ownerRecord' => $form, 'pageClass' => EditForm::class])
        ->assertSuccessful()
        ->assertCanSeeTableRecords([$request]);
});
