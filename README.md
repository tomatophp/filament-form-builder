![Screenshot](https://raw.githubusercontent.com/tomatophp/filament-form-builder/master/art/screenshot.jpg)

# Filament form builder

[![Latest Stable Version](https://poser.pugx.org/tomatophp/filament-form-builder/version.svg)](https://packagist.org/packages/tomatophp/filament-form-builder)
[![License](https://poser.pugx.org/tomatophp/filament-form-builder/license.svg)](https://packagist.org/packages/tomatophp/filament-form-builder)
[![Downloads](https://poser.pugx.org/tomatophp/filament-form-builder/d/total.svg)](https://packagist.org/packages/tomatophp/filament-form-builder)

Manage your forms using database and drop/drag component to build the form with Livewire component support for FilamentPHP

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
