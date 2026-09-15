<?php

namespace TomatoPHP\FilamentFormBuilder;

use Filament\Contracts\Plugin;
use Filament\Panel;
use LaraZeus\SpatieTranslatable\SpatieTranslatablePlugin;
use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormResource;

class FilamentFormBuilderPlugin implements Plugin
{
    /**
     * @var array<int, string>|null
     */
    protected ?array $locales = null;

    public function getId(): string
    {
        return 'filament-form-builder';
    }

    /**
     * Locales offered by the form locale switcher when this plugin registers the translatable plugin itself.
     *
     * @param  array<int, string>  $locales
     */
    public function locales(array $locales): static
    {
        $this->locales = $locales;

        return $this;
    }

    public function register(Panel $panel): void
    {
        // The form resource is translatable; register the translatable plugin unless the panel already has it.
        if (! $panel->hasPlugin('spatie-translatable')) {
            $panel->plugin(
                SpatieTranslatablePlugin::make()->defaultLocales($this->locales ?? [config('app.locale', 'en')])
            );
        }

        $panel->resources([
            FormResource::class,
        ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): self
    {
        return new FilamentFormBuilderPlugin;
    }
}
