<?php

namespace Modules\Admin\Providers;

use Modules\Admin\Ui\Facades\Form;
use Illuminate\Support\Facades\View;
use Modules\Base\Traits\AddsAsset;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Modules\Admin\Http\ViewComposers\AssetsComposer;

class AdminServiceProvider extends ServiceProvider
{
    use AddsAsset;
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('admin::layout', AssetsComposer::class);
        View::composer('admin::fullwidth-layout', AssetsComposer::class);
    
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        AliasLoader::getInstance()->alias('Form', Form::class);
    }

}
