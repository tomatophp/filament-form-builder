<?php

namespace TomatoPHP\FilamentFormBuilder\Filament\Resources;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormRequestResource\Pages\CreateFormRequest;
use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormRequestResource\Pages\EditFormRequest;
use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormRequestResource\Pages\ListFormRequests;
use TomatoPHP\FilamentFormBuilder\Models\FormRequest;

class FormRequestResource extends Resource
{
    protected static ?string $model = FormRequest::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('model_type')
                    ->maxLength(255),
                TextInput::make('model_id')
                    ->numeric(),
                TextInput::make('service_type')
                    ->maxLength(255),
                TextInput::make('service_id')
                    ->numeric(),
                TextInput::make('form_id')
                    ->required()
                    ->numeric(),
                TextInput::make('status')
                    ->maxLength(255)
                    ->default('pending'),
                TextInput::make('payload'),
                Textarea::make('description')
                    ->columnSpanFull(),
                DatePicker::make('date'),
                TextInput::make('time'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('model_type')
                    ->searchable(),
                TextColumn::make('model_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('service_type')
                    ->searchable(),
                TextColumn::make('service_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('form_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->searchable(),
                TextColumn::make('date')
                    ->date()
                    ->sortable(),
                TextColumn::make('time'),
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
            'index' => ListFormRequests::route('/'),
            'create' => CreateFormRequest::route('/create'),
            'edit' => EditFormRequest::route('/{record}/edit'),
        ];
    }
}
