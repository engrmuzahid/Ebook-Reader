<?php

namespace Modules\Menu\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Base\Traits\AddsAsset;
use Modules\Admin\Ui\Facades\TabManager;
use Modules\Menu\Admin\Tabs\MenuItemTabs;
use Modules\Menu\Admin\Tabs\MenuTabs;

class MenuServiceProvider extends ServiceProvider
{
    use AddsAsset;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        TabManager::register('menu_items', MenuItemTabs::class);
        TabManager::register('menus', MenuTabs::class);

        $this->addAdminAssets('admin.menus.(create|edit)', ['admin.menu.css', 'admin.menu.js']);
        $this->addAdminAssets('admin.menus.items.(create|edit)', ['admin.menu.js']);
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
