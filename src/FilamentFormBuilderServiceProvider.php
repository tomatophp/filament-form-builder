<?php

namespace TomatoPHP\FilamentFormBuilder;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Illuminate\Support\ServiceProvider;
use TomatoPHP\FilamentFormBuilder\Services\Contracts\CmsFormFieldType;
use TomatoPHP\FilamentFormBuilder\Services\FilamentCMSFormFields;
use TomatoPHP\FilamentIcons\Components\IconPicker;

class FilamentFormBuilderServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //Register generate command
        $this->commands([
            \TomatoPHP\FilamentFormBuilder\Console\FilamentFormBuilderInstall::class,
        ]);

        //Register Config file
        $this->mergeConfigFrom(__DIR__ . '/../config/filament-form-builder.php', 'filament-form-builder');

        //Publish Config
        $this->publishes([
            __DIR__ . '/../config/filament-form-builder.php' => config_path('filament-form-builder.php'),
        ], 'filament-form-builder-config');

        //Register Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        //Publish Migrations
        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'filament-form-builder-migrations');
        //Register views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'filament-form-builder');

        //Publish Views
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/filament-form-builder'),
        ], 'filament-form-builder-views');

        //Register Langs
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'filament-form-builder');

        //Publish Lang
        $this->publishes([
            __DIR__ . '/../resources/lang' => base_path('lang/vendor/filament-form-builder'),
        ], 'filament-form-builder-lang');

        //Register Routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

    }

    public function boot(): void
    {
        FilamentCMSFormFields::register([
            CmsFormFieldType::make('text')
                ->label('Text'),
            CmsFormFieldType::make('textarea')
                ->className(Textarea::class)
                ->color('warning')
                ->icon('heroicon-s-document-text')
                ->label('Textarea'),
            CmsFormFieldType::make('select')
                ->className(Select::class)
                ->color('info')
                ->icon('heroicon-s-squares-plus')
                ->label('Select'),
            CmsFormFieldType::make('checkbox')
                ->className(Checkbox::class)
                ->color('danger')
                ->icon('heroicon-s-check')
                ->label('Checkbox'),
            CmsFormFieldType::make('radio')
                ->className(Radio::class)
                ->color('success')
                ->icon('heroicon-s-check-circle')
                ->label('Radio'),
            CmsFormFieldType::make('file')
                ->className(FileUpload::class)
                ->color('info')
                ->icon('heroicon-s-document-arrow-up')
                ->label('File'),
            CmsFormFieldType::make('date')
                ->className(DatePicker::class)
                ->color('success')
                ->icon('heroicon-s-calendar')
                ->label('Date'),
            CmsFormFieldType::make('time')
                ->className(TimePicker::class)
                ->color('info')
                ->icon('heroicon-s-clock')
                ->label('Time'),
            CmsFormFieldType::make('datetime')
                ->className(DateTimePicker::class)
                ->color('warning')
                ->icon('heroicon-s-calendar-days')
                ->label('DateTime'),
            CmsFormFieldType::make('color')
                ->className(ColorPicker::class)
                ->color('success')
                ->icon('heroicon-s-swatch')
                ->label('Color'),
            CmsFormFieldType::make('icon')
                ->className(IconPicker::class)
                ->color('info')
                ->icon('heroicon-s-heart')
                ->label('Icon'),
            CmsFormFieldType::make('toggle')
                ->className(Toggle::class)
                ->color('success')
                ->icon('heroicon-s-adjustments-horizontal')
                ->label('Toggle'),
            CmsFormFieldType::make('password')
                ->color('danger')
                ->icon('heroicon-s-lock-closed')
                ->label('Password'),
            CmsFormFieldType::make('email')
                ->color('info')
                ->icon('heroicon-s-envelope')
                ->label('Email'),
            CmsFormFieldType::make('number')
                ->color('success')
                ->icon('heroicon-s-minus-circle')
                ->label('Number'),
            CmsFormFieldType::make('url')
                ->color('primary')
                ->icon('heroicon-s-globe-alt')
                ->label('URL'),
            CmsFormFieldType::make('tel')
                ->color('warning')
                ->icon('heroicon-s-phone')
                ->label('Tel'),
            CmsFormFieldType::make('markdown')
                ->className(MarkdownEditor::class)
                ->color('warning')
                ->icon('heroicon-s-hashtag')
                ->label('Markdown'),
            CmsFormFieldType::make('rich')
                ->className(RichEditor::class)
                ->color('info')
                ->icon('heroicon-s-document-text')
                ->label('RichText'),
            CmsFormFieldType::make('keyValue')
                ->className(KeyValue::class)
                ->color('danger')
                ->icon('heroicon-s-key')
                ->label('Key/Value'),
            CmsFormFieldType::make('repeater')
                ->className(Repeater::class)
                ->icon('heroicon-s-rectangle-group')
                ->label('Repeater'),
        ]);
    }
}
