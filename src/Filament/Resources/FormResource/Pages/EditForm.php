<?php

namespace TomatoPHP\FilamentFormBuilder\Filament\Resources\FormResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormResource;

class EditForm extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = FormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
