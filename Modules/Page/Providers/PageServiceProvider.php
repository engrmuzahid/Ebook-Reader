<?php

namespace Modules\Page\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Page\Admin\Tabs\PageTabs;
use Modules\Admin\Ui\Facades\TabManager;


class PageServiceProvider extends ServiceProvider
{
    

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        TabManager::register('pages', PageTabs::class);
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
