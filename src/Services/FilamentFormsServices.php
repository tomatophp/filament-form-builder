<?php

namespace TomatoPHP\FilamentFormBuilder\Services;

use TomatoPHP\FilamentFormBuilder\Services\Contracts\Form;

class FilamentFormsServices
{
    public array $forms = [];

    public function register(Form $form)
    {
        $this->forms[] = $form;
    }

    public function getForms(): array
    {
        return $this->forms;
    }

    public function build(): void
    {
        foreach ($this->forms as $form) {
            $checkIfFormExists = \TomatoPHP\FilamentFormBuilder\Models\Form::where('key', $form->key)->first();
            if (! $checkIfFormExists) {
                $newForm = \TomatoPHP\FilamentFormBuilder\Models\Form::create($form->toArray());
                $newForm->fields()->createMany($form->inputs);
            }
        }
    }
}
