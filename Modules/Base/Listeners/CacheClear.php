<?php

namespace Modules\Base\Listeners;

use Illuminate\Support\Facades\Artisan;

class CacheClear
{
    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle()
    {
        Artisan::call('config:clear');
        Artisan::call('route:trans:clear');
    }
}
