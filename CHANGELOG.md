# Changelog

### v5.0.1

- fix `php artisan optimize` / `view:cache` failing in the host app: the service provider registered and published a `resources/views` folder the package does not ship

### v5.0.0

- support Filament v5 and Laravel 12 / 13 (the Filament v3 line continues on the `v3` branch)
- fix installing the package (#4): the service provider loaded a `routes/web.php` file that was never shipped, the tables were only created when filament-cms enabled its forms feature, and several required packages were missing from `composer.json`
- the plugin now registers the form resource (it registered nothing) and the translatable plugin when the panel does not have it
- use the package translations instead of `filament-cms::messages`
- fix mass assignment of the form title and the casts that broke translatable field labels
- remove the unregistered `filament-form:generate` command that depended on classes that do not exist
- Pest suite with regression tests, phpstan config and the Laravel 12 / 13 CI matrix
- new cover and screenshots

### V1.0.0

First release of the package
