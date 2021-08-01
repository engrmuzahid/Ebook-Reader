<?php

namespace Modules\Base\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Maatwebsite\Sidebar\SidebarManager;
use Modules\Base\Sidebar\AdminSidebar;
use Modules\Base\Http\ViewCreators\AdminSidebarCreator;

class SidebarServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(SidebarManager $manager)
    {
        if (! config('app.installed')) {
            return;
        }

        if ($this->app['inAdmin']) {
            $manager->register(AdminSidebar::class);
        }

        View::creator('admin::include.sidebar', AdminSidebarCreator::class);
    }
}
