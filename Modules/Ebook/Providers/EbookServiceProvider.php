<?php

namespace Modules\Ebook\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Base\Traits\AddsAsset;
use Modules\Admin\Ui\Facades\TabManager;
use Modules\Ebook\Admin\Tabs\EbookTabs;


class EbookServiceProvider extends ServiceProvider
{
    use AddsAsset;
     
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        TabManager::register('ebooks', EbookTabs::class);
         $this->addAdminAssets('admin.ebooks.(create|edit)', [
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
