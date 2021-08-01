<?php

namespace Modules\Slider\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Admin\Ui\Facades\TabManager;
use Modules\Slider\Admin\Tabs\SliderTabs;
use Modules\Base\Traits\AddsAsset;



class SliderServiceProvider extends ServiceProvider
{
    use AddsAsset;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        TabManager::register('sliders', SliderTabs::class);

        $this->addAdminAssets('admin.sliders.(create|edit)', ['admin.files.js', 'admin.slider.css', 'admin.spectrum.min.js', 'admin.slider.js']);
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
