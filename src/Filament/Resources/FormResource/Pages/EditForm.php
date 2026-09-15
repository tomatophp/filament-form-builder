<?php

namespace TomatoPHP\FilamentFormBuilder\Filament\Resources\FormResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Pages\EditRecord\Concerns\Translatable;
use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormResource;

class EditForm extends EditRecord
{
    use Translatable;

    protected static string $resource = FormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            LocaleSwitcher::make(),
        ];
    }
}
