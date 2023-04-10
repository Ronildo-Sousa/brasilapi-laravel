<?php

declare(strict_types=1);

namespace BrasilApi\BrasilapiLaravel;

use BrasilApi\BrasilapiLaravel\Commands\BrasilapiLaravelCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class BrasilapiLaravelServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('brasilapi-laravel')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_brasilapi-laravel_table')
            ->hasCommand(BrasilapiLaravelCommand::class);
    }
}
