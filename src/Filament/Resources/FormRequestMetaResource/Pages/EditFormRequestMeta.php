<?php

namespace TomatoPHP\FilamentFormBuilder\Filament\Resources\FormRequestMetaResource\Pages;

use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormRequestMetaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

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
