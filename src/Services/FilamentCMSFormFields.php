<?php

namespace TomatoPHP\FilamentFormBuilder\Services;

use TomatoPHP\FilamentFormBuilder\Services\Contracts\CmsFormFieldType;

class FilamentCMSFormFields
{
    public static array $formFields = [];

    public static function register(CmsFormFieldType | array $field)
    {
        if (is_array($field)) {
            foreach ($field as $type) {
                self::register($type);
            }

            return;
        }
        self::$formFields[] = $field;
    }

    public static function getOptions()
    {
        return collect(self::$formFields);
    }
}
