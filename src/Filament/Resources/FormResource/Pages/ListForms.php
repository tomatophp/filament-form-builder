<?php

namespace TomatoPHP\FilamentFormBuilder\Filament\Resources\FormResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use LaraZeus\SpatieTranslatable\Resources\Pages\ManageRecords\Concerns\Translatable;
use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormResource;

class ListForms extends ManageRecords
{
    use Translatable;

    protected static string $resource = FormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
