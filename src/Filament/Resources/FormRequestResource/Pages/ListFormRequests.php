<?php

namespace TomatoPHP\FilamentFormBuilder\Filament\Resources\FormRequestResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormRequestResource;

class ListFormRequests extends ListRecords
{
    protected static string $resource = FormRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
