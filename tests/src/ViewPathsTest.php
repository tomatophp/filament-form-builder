<?php

use Illuminate\Support\Facades\View;

it('registers no view paths that do not exist', function () {
    $paths = View::getFinder()->getHints()['filament-form-builder'] ?? [];

    // A missing path makes `php artisan view:cache` (and `optimize`) fail in the host app.
    expect(array_filter($paths, fn (string $path): bool => ! is_dir($path)))->toBeEmpty();
});
