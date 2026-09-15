<?php

namespace TomatoPHP\FilamentFormBuilder\Filament\Resources\FormResource\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Infolists\Components\KeyValueEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use TomatoPHP\FilamentFormBuilder\Models\FormRequest;

class FormRequestsRelation extends RelationManager
{
    protected static string $relationship = 'requests';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return trans('filament-form-builder::messages.forms.requests.title');
    }

    public static function getLabel(): ?string
    {
        return trans('filament-form-builder::messages.forms.requests.title');
    }

    public static function getModelLabel(): ?string
    {
        return trans('filament-form-builder::messages.forms.requests.single');
    }

    public static function getPluralLabel(): ?string
    {
        return trans('filament-form-builder::messages.forms.requests.title');
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('status')
                    ->label(trans('filament-form-builder::messages.forms.requests.columns.status'))
                    ->searchable()
                    ->options([
                        'pending' => trans('filament-form-builder::messages.forms.requests.columns.pending'),
                        'processing' => trans('filament-form-builder::messages.forms.requests.columns.processing'),
                        'completed' => trans('filament-form-builder::messages.forms.requests.columns.completed'),
                        'cancelled' => trans('filament-form-builder::messages.forms.requests.columns.cancelled'),
                    ])
                    ->columnSpanFull()
                    ->default('pending'),
            ]);
    }

    public function infolist(Schema $schema): Schema
    {

        return $schema->components([
            TextEntry::make('description')
                ->label(trans('filament-form-builder::messages.forms.requests.columns.description'))
                ->columnSpanFull(),
            TextEntry::make('time')
                ->label(trans('filament-form-builder::messages.forms.requests.columns.time')),
            TextEntry::make('date')
                ->label(trans('filament-form-builder::messages.forms.requests.columns.date')),
            KeyValueEntry::make('payload')
                ->label(trans('filament-form-builder::messages.forms.requests.columns.payload'))
                ->columnSpanFull()
                ->schema(function (FormRequest $record) {
                    $getEntryText = [];
                    foreach ($record->payload as $key => $value) {
                        $field = $record->form->fields->where('key', $key)->first();
                        $getEntryText[] = TextEntry::make($key)
                            ->label($field->label ?? str($key)->title())
                            ->default($value)
                            ->columnSpanFull();
                    }

                    return $getEntryText;
                })
                ->columns(2),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('status')
                    ->label(trans('filament-form-builder::messages.forms.requests.columns.status'))
                    ->badge()
                    ->state(fn ($record) => match ($record->status) {
                        'pending' => trans('filament-form-builder::messages.forms.requests.columns.pending'),
                        'processing' => trans('filament-form-builder::messages.forms.requests.columns.processing'),
                        'completed' => trans('filament-form-builder::messages.forms.requests.columns.completed'),
                        'cancelled' => trans('filament-form-builder::messages.forms.requests.columns.cancelled'),
                        default => $record->status,
                    })
                    ->icon(fn ($record) => match ($record->status) {
                        'pending' => 'heroicon-s-rectangle-stack',
                        'processing' => 'heroicon-s-arrow-path',
                        'completed' => 'heroicon-s-check-circle',
                        'cancelled' => 'heroicon-s-x-circle',
                        default => 'heroicon-s-x-circle',
                    })
                    ->color(fn ($record) => match ($record->status) {
                        'pending' => 'info',
                        'processing' => 'warning',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'secondary',
                    })
                    ->searchable(),
                TextColumn::make('description')
                    ->label(trans('filament-form-builder::messages.forms.requests.columns.description')),
                TextColumn::make('date')
                    ->label(trans('filament-form-builder::messages.forms.requests.columns.date'))
                    ->date()
                    ->sortable(),
                TextColumn::make('time')
                    ->label(trans('filament-form-builder::messages.forms.requests.columns.time')),
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
                SelectFilter::make('status')
                    ->label(trans('filament-form-builder::messages.forms.requests.columns.status'))
                    ->searchable()
                    ->options([
                        'pending' => trans('filament-form-builder::messages.forms.requests.columns.pending'),
                        'processing' => trans('filament-form-builder::messages.forms.requests.columns.processing'),
                        'completed' => trans('filament-form-builder::messages.forms.requests.columns.completed'),
                        'cancelled' => trans('filament-form-builder::messages.forms.requests.columns.cancelled'),
                    ])
                    ->columnSpanFull(),
            ])
            ->defaultSort('created_at', 'desc')
            ->groups([
                Group::make('status'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
