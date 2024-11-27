<?php

namespace TomatoPHP\FilamentFormBuilder\Filament\Resources\FormOptionResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormOptionResource;

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
