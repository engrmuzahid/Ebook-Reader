<?php

namespace Modules\Setting\Providers;


use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\Base\Traits\AddsAsset;
use Modules\Setting\Admin\Tabs\SettingTabs;
use Modules\Admin\Ui\Facades\TabManager;

class SettingServiceProvider extends ServiceProvider
{
    use AddsAsset;
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        TabManager::register('settings', SettingTabs::class);

        $this->addAdminAssets('admin.settings.edit', ['admin.setting.js','admin.files.css','admin.files.js']);
    }

}
