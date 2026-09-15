<?php

namespace TomatoPHP\FilamentFormBuilder\Filament\Resources\FormRequestResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormRequestResource;

class EditFormRequest extends EditRecord
{
    protected static string $resource = FormRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
