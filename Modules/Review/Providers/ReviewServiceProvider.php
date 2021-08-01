<?php

namespace Modules\Review\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Base\Traits\AddsAsset;
use Modules\Admin\Ui\Facades\TabManager;
use Modules\Review\Admin\Tabs\ReviewTabs;
use Modules\Review\Admin\Tabs\EbookTabsExtender;

class ReviewServiceProvider extends ServiceProvider
{
    use AddsAsset;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        TabManager::register('reviews', ReviewTabs::class);
        TabManager::extend('ebooks', EbookTabsExtender::class);
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
