<?php

namespace TomatoPHP\FilamentFormBuilder\Filament\Resources;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormRequestMetaResource\Pages\CreateFormRequestMeta;
use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormRequestMetaResource\Pages\EditFormRequestMeta;
use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormRequestMetaResource\Pages\ListFormRequestMetas;
use TomatoPHP\FilamentFormBuilder\Models\FormRequestMeta;

class FormRequestMetaResource extends Resource
{
    protected static ?string $model = FormRequestMeta::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('model_id')
                    ->numeric(),
                TextInput::make('model_type')
                    ->maxLength(255),
                TextInput::make('form_request_id')
                    ->required()
                    ->numeric(),
                TextInput::make('key')
                    ->required()
                    ->maxLength(255),
                TextInput::make('value'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('model_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('model_type')
                    ->searchable(),
                TextColumn::make('form_request_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('key')
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
            'index' => ListFormRequestMetas::route('/'),
            'create' => CreateFormRequestMeta::route('/create'),
            'edit' => EditFormRequestMeta::route('/{record}/edit'),
        ];
    }
}
