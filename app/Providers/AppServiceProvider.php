<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom([
            database_path().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR.'Clients',
            database_path().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR.'Properties',
            database_path().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR.'Others',
            database_path().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR.'Address',
        ]);

        \Illuminate\Support\Collection::macro('toCollection', function () {
            return $this->map(function ($value) {
                if (is_array($value) || is_object($value)) {
                    return collect($value)->toCollection();
                }

                return $value;
            });
        });
    }
}
