<?php

namespace TomatoPHP\FilamentFormBuilder\Filament\Resources\FormResource\RelationManagers;

use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use TomatoPHP\FilamentFormBuilder\Models\Form;
use TomatoPHP\FilamentFormBuilder\Models\FormOption;
use TomatoPHP\FilamentFormBuilder\Services\FilamentCMSFormBuilder;
use TomatoPHP\FilamentFormBuilder\Services\FilamentCMSFormFields;
use TomatoPHP\FilamentTranslationComponent\Components\Translation;

class FormFieldsRelation extends RelationManager
{
    protected static string $relationship = 'fields';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return trans('filament-form-builder::messages.forms.fields.title');
    }

    public static function getLabel(): ?string
    {
        return trans('filament-form-builder::messages.forms.fields.title');
    }

    public static function getModelLabel(): ?string
    {
        return trans('filament-form-builder::messages.forms.fields.single');
    }

    public static function getPluralLabel(): ?string
    {
        return trans('filament-form-builder::messages.forms.fields.title');
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make()
                    ->schema([
                        Tab::make(trans('filament-form-builder::messages.forms.fields.tabs.general'))
                            ->icon('heroicon-s-information-circle')
                            ->schema([
                                Select::make('type')
                                    ->label(trans('filament-form-builder::messages.forms.fields.columns.type'))
                                    ->searchable()
                                    ->options(FilamentCMSFormFields::getOptions()->pluck('label', 'name')->toArray())
                                    ->default('text'),
                                TextInput::make('name')
                                    ->label(trans('filament-form-builder::messages.forms.fields.columns.name'))
                                    ->live()
                                    ->afterStateUpdated(function (Get $get, Set $set, $state) {
                                        if (str($state)->contains('email')) {
                                            $set('type', 'email');
                                        }
                                        if (str($state)->contains('phone')) {
                                            $set('type', 'tel');
                                        }
                                        if (str($state)->contains(['is_', 'has_'])) {
                                            $set('type', 'toggle');
                                        }
                                        if (str($state)->contains(['at', 'date'])) {
                                            $set('type', 'date');
                                        }
                                        if (str($state)->contains('password')) {
                                            $set('type', 'password');
                                        }
                                        if (str($state)->contains(['description', 'message'])) {
                                            $set('type', 'textarea');
                                        }
                                        if (str($state)->contains(['body', 'about'])) {
                                            $set('type', 'rich');
                                        }
                                        if (str($state)->contains('price')) {
                                            $set('type', 'number');
                                        }

                                    })
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('group')
                                    ->label(trans('filament-form-builder::messages.forms.fields.columns.group'))
                                    ->maxLength(255),
                                TextInput::make('default')
                                    ->label(trans('filament-form-builder::messages.forms.fields.columns.default')),
                            ])->columns(2),
                        //                        Forms\Components\Tabs\Tab::make('Reactive')
                        //                            ->schema([
                        //                                Forms\Components\Toggle::make('is_reactive')
                        //                                    ->live(),
                        //                                Forms\Components\Select::make('reactive_field')
                        //                                    ->hidden(fn(Forms\Get $get) => !$get('is_reactive'))
                        //                                    ->searchable()
                        //                                    ->options(function(){
                        //                                        return FormOption::query()->where('form_id', $this->getOwnerRecord()->id)->pluck('name', 'name')->toArray();
                        //                                    }),
                        //                                Forms\Components\Repeater::make('reactive_where')
                        //                                    ->hidden(fn(Forms\Get $get) => !$get('is_reactive'))
                        //                                    ->schema([
                        //                                        Forms\Components\Select::make('field')
                        //                                            ->searchable()
                        //                                            ->options(function(){
                        //                                                return FormOption::query()->where('form_id', $this->getOwnerRecord()->id)->pluck('name', 'name')->toArray();
                        //                                            }),
                        //                                        Forms\Components\Select::make('operator')
                        //                                            ->options([
                        //                                                '=' => '=',
                        //                                                '!=' => '!=',
                        //                                                '>' => '>',
                        //                                                '<' => '<',
                        //                                                '>=' => '>=',
                        //                                                '<=' => '<='
                        //                                            ]),
                        //                                        Forms\Components\TextInput::make('value')
                        //                                            ->maxLength(255)
                        //                                    ])->columns(3),
                        //                            ]),
                        Tab::make(trans('filament-form-builder::messages.forms.fields.tabs.relation'))
                            ->icon('heroicon-s-squares-plus')
                            ->schema([
                                Toggle::make('is_relation')
                                    ->label(trans('filament-form-builder::messages.forms.fields.columns.is_relation'))
                                    ->columnSpanFull()
                                    ->live(),
                                TextInput::make('relation_name')
                                    ->label(trans('filament-form-builder::messages.forms.fields.columns.relation_name'))
                                    ->hidden(fn (Get $get) => ! $get('is_relation'))
                                    ->maxLength(255),
                                TextInput::make('relation_column')
                                    ->label(trans('filament-form-builder::messages.forms.fields.columns.relation_column'))
                                    ->hidden(fn (Get $get) => ! $get('is_relation'))
                                    ->maxLength(255),
                            ])->columns(2),
                        Tab::make(trans('filament-form-builder::messages.forms.fields.tabs.options'))
                            ->icon('heroicon-s-rectangle-group')
                            ->schema([
                                Select::make('sub_form')
                                    ->label(trans('filament-form-builder::messages.forms.fields.columns.sub_form'))
                                    ->searchable()
                                    ->options(Form::query()->where('id', '!=', $this->getOwnerRecord()->id)->pluck('key', 'id')->toArray()),
                                Toggle::make('is_multi')
                                    ->label(trans('filament-form-builder::messages.forms.fields.columns.is_multi')),
                                Toggle::make('has_options')
                                    ->label(trans('filament-form-builder::messages.forms.fields.columns.has_options'))
                                    ->live(),
                                Repeater::make('options')
                                    ->label(trans('filament-form-builder::messages.forms.fields.columns.options'))
                                    ->schema([
                                        Translation::make('label')->label(trans('filament-form-builder::messages.forms.fields.columns.label')),
                                        TextInput::make('value')->label(trans('filament-form-builder::messages.forms.fields.columns.value')),
                                    ])
                                    ->hidden(fn (Get $get) => ! $get('has_options')),
                            ]),
                        Tab::make(trans('filament-form-builder::messages.forms.fields.tabs.labels'))
                            ->icon('heroicon-s-language')
                            ->schema([
                                Translation::make('label')
                                    ->label(trans('filament-form-builder::messages.forms.fields.columns.label')),
                                Translation::make('placeholder')
                                    ->label(trans('filament-form-builder::messages.forms.fields.columns.placeholder')),
                                Translation::make('hint')
                                    ->label(trans('filament-form-builder::messages.forms.fields.columns.hint')),
                            ]),
                        Tab::make(trans('filament-form-builder::messages.forms.fields.tabs.validation'))
                            ->icon('heroicon-s-variable')
                            ->schema([
                                Toggle::make('is_required')
                                    ->label(trans('filament-form-builder::messages.forms.fields.columns.is_required'))
                                    ->live(),
                                Translation::make('required_message')
                                    ->label(trans('filament-form-builder::messages.forms.fields.columns.required_message'))
                                    ->hidden(fn (Get $get) => ! $get('is_required')),
                                Toggle::make('has_validation')
                                    ->label(trans('filament-form-builder::messages.forms.fields.columns.has_validation'))
                                    ->live(),
                                Repeater::make('validation')
                                    ->label(trans('filament-form-builder::messages.forms.fields.columns.validation'))
                                    ->schema([
                                        TextInput::make('rule')->label(trans('filament-form-builder::messages.forms.fields.columns.rule')),
                                        Translation::make('message')->label(trans('filament-form-builder::messages.forms.fields.columns.message')),
                                    ])
                                    ->hidden(fn (Get $get) => ! $get('has_validation')),
                            ]),
                    ]),
            ])->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make()
                    ->icon('heroicon-s-plus-circle')
                    ->after(function (array $data, $record) {
                        $record->name = Str::of($record->name)->replace(' ', '_')->lower()->toString();
                        $record->save();
                    }),
                Action::make('preview')
                    ->label(trans('filament-form-builder::messages.forms.fields.actions.preview'))
                    ->icon('heroicon-s-eye')
                    ->color('info')
                    ->schema(function () {
                        return FilamentCMSFormBuilder::make($this->getOwnerRecord()->key)->build();
                    })->action(function (array $data) {
                        FilamentCMSFormBuilder::make($this->getOwnerRecord()->key)->send($data);
                    }),
            ])
            ->recordActions([
                EditAction::make()->after(function (array $data, $record) {
                    $record->name = Str::of($record->name)->replace(' ', '_')->lower()->toString();
                    $record->save();
                }),
                DeleteAction::make(),
            ])
            ->columns([
                TextColumn::make('type')
                    ->label(trans('filament-form-builder::messages.forms.fields.columns.type'))
                    ->badge()
                    ->icon(fn ($record) => FilamentCMSFormFields::getOptions()->where('name', $record->type)->first()->icon)
                    ->color(fn ($record) => FilamentCMSFormFields::getOptions()->where('name', $record->type)->first()->color)
                    ->state(fn ($record) => FilamentCMSFormFields::getOptions()->where('name', $record->type)->first()->label)
                    ->searchable(),
                TextColumn::make('name')
                    ->label(trans('filament-form-builder::messages.forms.fields.columns.name'))
                    ->searchable(),
                ToggleColumn::make('is_required')
                    ->label(trans('filament-form-builder::messages.forms.fields.columns.is_required'))
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->groups([
                Group::make('group'),
            ])
            ->defaultSort('created_at')
            ->toolbarActions([
                DeleteBulkAction::make(),
            ])
            ->reorderable('order');
    }
}
