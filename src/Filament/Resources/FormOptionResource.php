<?php

namespace TomatoPHP\FilamentFormBuilder\Filament\Resources;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormOptionResource\Pages\CreateFormOption;
use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormOptionResource\Pages\EditFormOption;
use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormOptionResource\Pages\ListFormOptions;
use TomatoPHP\FilamentFormBuilder\Models\FormOption;

class FormOptionResource extends Resource
{
    protected static ?string $model = FormOption::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('form_id')
                    ->required()
                    ->numeric(),
                TextInput::make('type')
                    ->maxLength(255)
                    ->default('text'),
                TextInput::make('label'),
                TextInput::make('placeholder'),
                TextInput::make('hint'),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('group')
                    ->maxLength(255),
                TextInput::make('default'),
                TextInput::make('order')
                    ->numeric()
                    ->default(0),
                Toggle::make('is_required'),
                Toggle::make('is_multi'),
                TextInput::make('required_message'),
                Toggle::make('is_reactive'),
                TextInput::make('reactive_field')
                    ->maxLength(255),
                TextInput::make('reactive_where')
                    ->maxLength(255),
                Toggle::make('is_relation'),
                TextInput::make('relation_name')
                    ->maxLength(255),
                TextInput::make('relation_column')
                    ->maxLength(255),
                Toggle::make('has_options'),
                TextInput::make('options'),
                Toggle::make('has_validation'),
                TextInput::make('validation'),
                TextInput::make('meta'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('form_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('type')
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('group')
                    ->searchable(),
                TextColumn::make('order')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_required')
                    ->boolean(),
                IconColumn::make('is_multi')
                    ->boolean(),
                IconColumn::make('is_reactive')
                    ->boolean(),
                TextColumn::make('reactive_field')
                    ->searchable(),
                TextColumn::make('reactive_where')
                    ->searchable(),
                IconColumn::make('is_relation')
                    ->boolean(),
                TextColumn::make('relation_name')
                    ->searchable(),
                TextColumn::make('relation_column')
                    ->searchable(),
                IconColumn::make('has_options')
                    ->boolean(),
                IconColumn::make('has_validation')
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFormOptions::route('/'),
            'create' => CreateFormOption::route('/create'),
            'edit' => EditFormOption::route('/{record}/edit'),
        ];
    }
}
