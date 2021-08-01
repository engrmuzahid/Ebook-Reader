<?php

namespace Modules\Files\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Modules\Base\Traits\AddsAsset;
use Modules\Admin\Http\ViewComposers\AssetsComposer;

class FilesServiceProvider extends ServiceProvider
{
    use AddsAsset;
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        
        
        View::composer('files::admin.files.create', AssetsComposer::class);
        View::composer('files::admin.files.manager', AssetsComposer::class);
        
        $this->addAdminAssets('admin.files.(index|edit|manager)', ['admin.files.css','admin.files.js']);
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
