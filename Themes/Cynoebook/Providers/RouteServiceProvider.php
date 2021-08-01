<?php

namespace Themes\Cynoebook\Providers;

use Modules\Base\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
   /**
     * The Themes namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $namespace = 'Themes\Cynoebook\Http\Controllers';

    /**
     * Get admin routes.
     *
     * @return string
     */
    protected function admin()
    {
        return __DIR__ . '/../routes/admin.php';
    }
    
    /**
     * Get public routes.
     *
     * @return string
     */
    protected function public()
    {
        return __DIR__ . '/../routes/public.php';
    }

}
