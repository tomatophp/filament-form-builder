<?php

namespace TomatoPHP\FilamentFormBuilder\Filament\Resources;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;
use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormResource\Pages\EditForm;
use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormResource\Pages\ListForms;
use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormResource\RelationManagers\FormFieldsRelation;
use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormResource\RelationManagers\FormRequestsRelation;
use TomatoPHP\FilamentFormBuilder\Models\Form as FormModel;

class FormResource extends Resource
{
    use Translatable;

    protected static ?string $model = FormModel::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-identification';

    public static function getNavigationGroup(): ?string
    {
        return trans('filament-form-builder::messages.group');
    }

    public static function getPluralLabel(): ?string
    {
        return trans('filament-form-builder::messages.forms.title');
    }

    public static function getLabel(): ?string
    {
        return trans('filament-form-builder::messages.forms.single');
    }

    public static function getNavigationLabel(): string
    {
        return trans('filament-form-builder::messages.forms.title');
    }

    public static function form(Schema $schema): Schema
    {
        $formSchema = [
            Select::make('type')
                ->label(trans('filament-form-builder::messages.forms.columns.type'))
                ->searchable()
                ->options([
                    'page' => 'Page',
                    'modal' => 'Modal',
                    'slideover' => 'Slideover',
                ])
                ->default('page'),
            Select::make('method')
                ->label(trans('filament-form-builder::messages.forms.columns.method'))
                ->searchable()
                ->options([
                    'POST' => 'POST',
                    'GET' => 'GET',
                    'PUT' => 'PUT',
                    'DELETE' => 'DELETE',
                    'PATCH' => 'PATCH',
                ])
                ->default('POST'),
            TextInput::make('title')
                ->label(trans('filament-form-builder::messages.forms.columns.title')),
            TextInput::make('key')
                ->label(trans('filament-form-builder::messages.forms.columns.key'))
                ->default(Str::random(6))
                ->unique(ignoreRecord: true)
                ->required()
                ->maxLength(255),
            Textarea::make('description')
                ->label(trans('filament-form-builder::messages.forms.columns.description'))
                ->columnSpanFull(),
            TextInput::make('endpoint')
                ->label(trans('filament-form-builder::messages.forms.columns.endpoint'))
                ->columnSpanFull()
                ->maxLength(255)
                ->default('/'),
            Toggle::make('is_active')
                ->label(trans('filament-form-builder::messages.forms.columns.is_active')),
        ];

        return $schema
            ->components(fn ($record) => $record ? [
                Section::make(trans('filament-form-builder::messages.forms.section.information'))
                    ->collapsible()
                    ->collapsed(fn ($record) => $record)
                    ->schema($formSchema),
            ] : $formSchema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type')
                    ->label(trans('filament-form-builder::messages.forms.columns.type'))
                    ->searchable(),
                TextColumn::make('title')
                    ->label(trans('filament-form-builder::messages.forms.columns.title'))
                    ->searchable(),
                TextColumn::make('key')
                    ->label(trans('filament-form-builder::messages.forms.columns.key'))
                    ->searchable(),
                TextColumn::make('endpoint')
                    ->label(trans('filament-form-builder::messages.forms.columns.endpoint'))
                    ->searchable(),
                TextColumn::make('method')
                    ->label(trans('filament-form-builder::messages.forms.columns.method'))
                    ->searchable(),
                IconColumn::make('is_active')
                    ->label(trans('filament-form-builder::messages.forms.columns.is_active'))
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            FormFieldsRelation::class,
            FormRequestsRelation::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListForms::route('/'),
            'edit' => EditForm::route('/{record}/edit'),
        ];
    }
}
