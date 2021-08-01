<?php

namespace Modules\Author\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Base\Traits\AddsAsset;
use Modules\Admin\Ui\Facades\TabManager;
use Modules\Author\Admin\Tabs\AuthorTabs;

class AuthorServiceProvider extends ServiceProvider
{
    use AddsAsset;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        TabManager::register('authors', AuthorTabs::class);
         $this->addAdminAssets('admin.authors.(create|edit)', [
            'admin.files.css', 'admin.files.js',
        ]);
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
