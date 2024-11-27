<?php

namespace TomatoPHP\FilamentFormBuilder\Filament\Resources\FormOptionResource\Pages;

use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFormOption extends EditRecord
{
    protected static string $resource = FormOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
