<?php

namespace Modules\Page\Providers;

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Base\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $namespace = 'Modules\Page\Http\Controllers';

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        $this->app->booted(function () {
            Route::get('{slug}', '\Modules\Page\Http\Controllers\PageController@show')
                ->prefix(LaravelLocalization::setLocale())
                ->middleware(['localize', 'locale_session_redirect', 'localization_redirect', 'web']);
        });
    }
    
    /**
     * Get admin routes.
     *
     * @return string
     */
    protected function admin()
    {
        return __DIR__ . '/../Routes/admin.php';
    }
    
    /**
     * Get public routes.
     *
     * @return string
     */
    protected function public()
    {
        return __DIR__ . '/../Routes/public.php';
    }

    
}
