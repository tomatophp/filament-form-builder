<?php

namespace TomatoPHP\FilamentFormBuilder\Filament\Resources\FormOptionResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormOptionResource;

class ListFormOptions extends ListRecords
{
    protected static string $resource = FormOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
