<?php

namespace Modules\Category\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Base\Traits\AddsAsset;


class CategoryServiceProvider extends ServiceProvider
{
    use AddsAsset;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->addAdminAssets('admin.categories.index', ['admin.category.css', 'admin.jstree.js', 'admin.category.js']);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        
    }
}
