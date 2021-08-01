<?php

namespace Modules\Base\Sidebar;

use Modules\User\Contracts\Authentication;

class BaseSidebarExtender
{
    protected $auth;

     public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    } 
}
