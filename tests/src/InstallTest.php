<?php

use Filament\Facades\Filament;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use TomatoPHP\FilamentFormBuilder\Filament\Resources\FormResource;
use TomatoPHP\FilamentFormBuilder\FilamentFormBuilderPlugin;
use TomatoPHP\FilamentFormBuilder\FilamentFormBuilderServiceProvider;

/**
 * Regression tests for tomatophp/filament-form-builder#4 "Cannot install the package":
 * the provider loaded a routes/web.php file that was never shipped, and the migrations
 * only ran when the separate filament-cms package enabled its "forms" feature.
 */
it('boots the service provider without a routes file', function () {
    expect(file_exists(__DIR__ . '/../../routes/web.php'))->toBeFalse()
        ->and(app()->getProviders(FilamentFormBuilderServiceProvider::class))->not->toBeEmpty();

    (new FilamentFormBuilderServiceProvider(app()))->register();
});

it('creates its tables without filament-cms installed', function () {
    expect(config('filament-cms'))->toBeNull()
        ->and(Schema::hasTable('forms'))->toBeTrue()
        ->and(Schema::hasTable('form_options'))->toBeTrue()
        ->and(Schema::hasColumn('form_options', 'sub_form'))->toBeTrue()
        ->and(Schema::hasTable('form_requests'))->toBeTrue()
        ->and(Schema::hasTable('form_request_metas'))->toBeTrue();
});

it('declares every package it uses as a composer dependency', function () {
    $require = json_decode(file_get_contents(__DIR__ . '/../../composer.json'), true)['require'];

    expect($require)->toHaveKeys([
        'filament/filament',
        'filament/spatie-laravel-media-library-plugin',
        'lara-zeus/spatie-translatable',
        'tomatophp/filament-icons',
        'tomatophp/filament-translation-component',
    ])->and(json_decode(file_get_contents(__DIR__ . '/../../composer.json'), true)['version'])->toMatch('/^\d+\.\d+\.\d+$/');
});

it('registers the form resource on the panel', function () {
    $panel = Filament::getPanel('admin');

    expect($panel->getPlugin('filament-form-builder'))->toBeInstanceOf(FilamentFormBuilderPlugin::class)
        ->and($panel->getResources())->toContain(FormResource::class);
});

it('runs the install command', function () {
    expect(Artisan::all())->toHaveKey('filament-form-builder:install');

    $this->artisan('filament-form-builder:install')->assertSuccessful();
});

it('uses its own translations instead of filament-cms ones', function () {
    expect(FormResource::getNavigationLabel())->toBe('Form Builder')
        ->and(FormResource::getNavigationGroup())->toBe('Content');
});
