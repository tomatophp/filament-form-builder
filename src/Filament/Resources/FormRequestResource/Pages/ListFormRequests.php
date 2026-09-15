<?php

namespace TomatoPHP\FilamentFormBuilder\Filament\Resources\FormRequestResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormRequestResource;

class ListFormRequests extends ListRecords
{
    protected static string $resource = FormRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
