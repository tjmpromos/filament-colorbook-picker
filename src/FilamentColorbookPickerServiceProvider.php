<?php

namespace Dymond\FilamentColorbookPicker;

use Dymond\FilamentColorbookPicker\Forms\Components\ColorbookPicker;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentColorbookPickerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('filament-colorbook-picker')
            ->hasConfigFile()
            ->hasViews()
            ->hasAssets();
    }
    public function packageBooted() {
        Livewire::component('filament-colorbook-picker::colorbook-picker', ColorbookPicker::class);
    }
}
