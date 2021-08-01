<?php

namespace Modules\Admin\Ui\Facades;

use Illuminate\Support\Facades\Facade;

class TabManager extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Modules\Admin\Ui\CiTabManager::class;
    }
}
