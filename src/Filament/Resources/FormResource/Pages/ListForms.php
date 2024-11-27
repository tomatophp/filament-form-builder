<?php

namespace TomatoPHP\FilamentFormBuilder\Filament\Resources\FormResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormResource;

class ListForms extends ManageRecords
{
    use ManageRecords\Concerns\Translatable;

    protected static string $resource = FormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
