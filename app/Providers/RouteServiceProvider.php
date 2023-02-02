<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $defaultNamespace = 'App\Http\Controllers';
    protected $clientNamespace = 'App\Http\Controllers\Clients';
    protected $addressNamespace = 'App\Http\Controllers\Address';
    protected $propertyNamespace = 'App\Http\Controllers\Property';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapAreaRoutes();

        $this->mapCountryRoutes();

        $this->mapCityRoutes();

        $this->mapAuthRoutes();

        $this->mapFileRoutes();

        $this->mapUserRoutes();

        $this->mapFavoriteRoutes();

        $this->mapImageRoutes();

        $this->mapOptionRoutes();

        $this->mapPropertyRoutes();

        $this->mapPropertyOptionRoutes();

        $this->mapPropertyTypeRoutes();

        $this->mapTypeRoutes();

        $this->mapTypeOptionRoutes();

        $this->mapTypeSpecRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->defaultNamespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->defaultNamespace)
            ->group(base_path('routes/api.php'));
    }


    protected function mapAreaRoutes()
    {
        Route::prefix('area')
            ->middleware('api')
            ->namespace($this->addressNamespace)
            ->group(base_path('routes/Address/area.php'));
    }

    protected function mapCityRoutes()
    {
        Route::prefix('city')
            ->middleware('api')
            ->namespace($this->addressNamespace)
            ->group(base_path('routes/Address/city.php'));
    }

    protected function mapCountryRoutes()
    {
        Route::prefix('country')
            ->middleware('auth:api')
            ->namespace($this->addressNamespace)
            ->group(base_path('routes/Address/country.php'));
    }

    protected function mapAuthRoutes()
    {
        Route::prefix('auth')
            ->middleware('api')
            ->namespace($this->clientNamespace)
            ->group(base_path('routes/Clients/auth.php'));
    }

    protected function mapFileRoutes()
    {
        Route::prefix('file')
            ->middleware('auth:api')
            ->namespace($this->clientNamespace)
            ->group(base_path('routes/Clients/file.php'));
    }

    protected function mapUserRoutes()
    {
        Route::prefix('user')
            ->middleware('api')
            ->namespace($this->clientNamespace)
            ->group(base_path('routes/Clients/user.php'));
    }

    protected function mapFavoriteRoutes()
    {
        Route::prefix('favorite')
            ->middleware('api')
            ->namespace($this->clientNamespace)
            ->group(base_path('routes/Clients/favorite.php'));
    }

    protected function mapImageRoutes()
    {
        Route::prefix('image')
            ->middleware('image')
            ->namespace($this->propertyNamespace)
            ->group(base_path('routes/Properties/image.php'));
    }

    protected function mapOptionRoutes()
    {
        Route::prefix('option')
            ->middleware('api')
            ->namespace($this->propertyNamespace)
            ->group(base_path('routes/Properties/option.php'));
    }


    protected function mapPropertyRoutes()
    {
        Route::prefix('property')
            ->middleware('auth:api')
            ->namespace($this->propertyNamespace)
            ->group(base_path('routes/Properties/property.php'));
    }


    protected function mapPropertyOptionRoutes()
    {
        Route::prefix('propertyOption')
            ->middleware('api')
            ->namespace($this->propertyNamespace)
            ->group(base_path('routes/Properties/propertyOption.php'));
    }


    protected function mapPropertyTypeRoutes()
    {
        Route::prefix('propertyType')
            ->middleware('api')
            ->namespace($this->propertyNamespace)
            ->group(base_path('routes/Properties/propertyType.php'));
    }

    protected function mapTypeRoutes()
    {
        Route::prefix('type')
            ->middleware('auth:api')
            ->namespace($this->propertyNamespace)
            ->group(base_path('routes/Properties/type.php'));
    }

    protected function mapTypeOptionRoutes()
    {
        Route::prefix('typeOption')
            ->middleware('api')
            ->namespace($this->propertyNamespace)
            ->group(base_path('routes/Properties/typeOption.php'));
    }

    protected function mapTypeSpecRoutes()
    {
        Route::prefix('typeSpec')
            ->middleware('api')
            ->namespace($this->propertyNamespace)
            ->group(base_path('routes/Properties/typeSpec.php'));
    }



}
