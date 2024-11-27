<?php

namespace TomatoPHP\FilamentFormBuilder\Filament\Resources\FormRequestResource\Pages;

use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFormRequest extends EditRecord
{
    protected static string $resource = FormRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
