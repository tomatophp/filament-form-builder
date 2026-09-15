![Screenshot](https://raw.githubusercontent.com/tomatophp/filament-form-builder/master/arts/fadymondy-tomato-form-builder.jpg)

# Filament form builder

[![Latest Stable Version](https://poser.pugx.org/tomatophp/filament-form-builder/version.svg)](https://packagist.org/packages/tomatophp/filament-form-builder)
[![License](https://poser.pugx.org/tomatophp/filament-form-builder/license.svg)](https://packagist.org/packages/tomatophp/filament-form-builder)
[![Downloads](https://poser.pugx.org/tomatophp/filament-form-builder/d/total.svg)](https://packagist.org/packages/tomatophp/filament-form-builder)

Manage your forms using database and drop/drag component to build the form with Livewire component support for FilamentPHP

## Screenshots

| Light | Dark |
|-------|------|
| ![Forms](https://raw.githubusercontent.com/tomatophp/filament-form-builder/master/arts/forms-light.png) | ![Forms](https://raw.githubusercontent.com/tomatophp/filament-form-builder/master/arts/forms-dark.png) |
| ![Form Fields](https://raw.githubusercontent.com/tomatophp/filament-form-builder/master/arts/form-fields-light.png) | ![Form Fields](https://raw.githubusercontent.com/tomatophp/filament-form-builder/master/arts/form-fields-dark.png) |

## Features

- [x] Build forms from the panel (page, modal or slide-over forms with an endpoint and method)
- [x] 21 field types (text, textarea, select, checkbox, radio, file, date, time, color, icon, toggle, markdown, rich text, key/value, repeater...)
- [x] Translatable labels, placeholders, hints and validation messages
- [x] Options, relations, sub forms and validation rules per field
- [x] Preview a form and store its submissions as form requests
- [x] Build a Filament schema from a stored form with `FilamentCMSFormBuilder::make('key')->build()`

## Requirements

| Package version | Filament | Laravel     | PHP  |
|-----------------|----------|-------------|------|
| 5.x             | 5.x      | 12.x, 13.x  | 8.2+ |
| 1.x             | 3.x      | 10.x, 11.x  | 8.1+ |

The Filament v3 line continues on the [`v3`](https://github.com/tomatophp/filament-form-builder/tree/v3) branch.

## Installation

```bash
composer require tomatophp/filament-form-builder
```
after install your package please run this command

```bash
php artisan filament-form-builder:install
```

finally register the plugin on `/app/Providers/Filament/AdminPanelProvider.php`

```php
->plugin(\TomatoPHP\FilamentFormBuilder\FilamentFormBuilderPlugin::make())
```

The form resource is translatable. The plugin registers `LaraZeus\SpatieTranslatable\SpatieTranslatablePlugin` for you unless your panel already has it; choose the locales with `FilamentFormBuilderPlugin::make()->locales(['en', 'ar'])`.

## Use a stored form

```php
use TomatoPHP\FilamentFormBuilder\Services\FilamentCMSFormBuilder;

// Inside any Filament action or schema
->schema(FilamentCMSFormBuilder::make('contact-us')->build())
->action(fn (array $data) => FilamentCMSFormBuilder::make('contact-us')->send($data));
```


## Publish Assets

you can publish config file by use this command

```bash
php artisan vendor:publish --tag="filament-form-builder-config"
```

you can publish views file by use this command

```bash
php artisan vendor:publish --tag="filament-form-builder-views"
```

you can publish languages file by use this command

```bash
php artisan vendor:publish --tag="filament-form-builder-lang"
```

you can publish migrations file by use this command

```bash
php artisan vendor:publish --tag="filament-form-builder-migrations"
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security

Please see [SECURITY](SECURITY.md) for more information about security.

## Credits

- [Fady Mondy](mailto:info@3x1.io)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
