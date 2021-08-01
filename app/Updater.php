<?php

namespace App;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class Updater
{
    public static function run()
    {
        set_time_limit(0);

        self::runMigrate();
        self::runClearCache();
        
        File::delete(storage_path('app/update'));
    }

    private static function runMigrate()
    {
        if (config('app.installed')) {
            Artisan::call('migrate', ['--force' => true]);
        }
    }

    private static function runClearCache()
    {
        Artisan::call('view:clear');
        Artisan::call('config:clear');
        Artisan::call('route:trans:clear');
        Artisan::call('cache:clear');
    }

    
}
