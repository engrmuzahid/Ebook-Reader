<?php

namespace Modules\Meta\Providers;

use Illuminate\Support\ServiceProvider;

class MetaServiceProvider extends ServiceProvider
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
