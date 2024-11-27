<?php

namespace TomatoPHP\FilamentFormBuilder\Filament\Resources\FormRequestMetaResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormRequestMetaResource;

class EditFormRequestMeta extends EditRecord
{
    protected static string $resource = FormRequestMetaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
