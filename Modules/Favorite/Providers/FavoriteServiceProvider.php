<?php

namespace Modules\Favorite\Providers;

use Illuminate\Support\ServiceProvider;

class FavoriteServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
