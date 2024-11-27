<?php

namespace TomatoPHP\FilamentFormBuilder\Filament\Resources\FormRequestMetaResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormRequestMetaResource;

class ListFormRequestMetas extends ListRecords
{
    protected static string $resource = FormRequestMetaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
