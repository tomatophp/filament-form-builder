<?php

namespace TomatoPHP\FilamentFormBuilder\Services\Contracts;

use Exception;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;

class FormInputOption
{
    public ?string $value = null;

    public ?string $label_ar = null;

    public ?string $label_en = null;

    public function __construct()
    {
        // decrypt
        try {
            $decryptedString = Crypt::decrypt(Cookie::get('lang'), false);
            $lang = json_decode(explode('|', $decryptedString)[1]);
            app()->setLocale($lang->id ?? config('app.locale'));
        } catch (Exception $exception) {
        }
    }

    public function toArray(): array
    {
        return [
            'value' => $this->value,
            'label_ar' => $this->label_ar,
            'label_en' => $this->label_en,
        ];
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public function value(string $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function label_ar(string $label_ar): static
    {
        $this->label_ar = $label_ar;

        return $this;
    }

    public function label_en(string $label_en): static
    {
        $this->label_en = $label_en;

        return $this;
    }
}
