<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;
use Nikhiltester\Stylist\StylistServiceProvider;
use Nwidart\Modules\LaravelModulesServiceProvider;
use Jackiedo\DotenvEditor\DotenvEditorServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(StylistServiceProvider::class);
        $this->app->register(LaravelModulesServiceProvider::class);

        if (! config('app.installed')) {
            $this->app->register(DotenvEditorServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('alpha_num_dash_spaces', function ($attribute, $value) {

            // This will only accept alpha and spaces - /^[\pL\s]+$/u. 
            // If you want to accept hyphens use: /^[\pL\s-]+$/u.
            return preg_match('/^[\w\s-]*$/', $value); 

        });
        Validator::extend('url_ext', function ($attribute, $value) {
            $allowEx=get_allowed_file_types();
            $ext = pathinfo($value, PATHINFO_EXTENSION);
            if(in_array($ext,$allowEx) && $ext!=='epub'){
                return true;
            }
            return false;

        });
        Schema::defaultStringLength(191);

        if (Request::secure()) {
            URL::forceScheme('https');
        }
    }
}
