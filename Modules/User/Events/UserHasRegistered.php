<?php

namespace Modules\User\Events;

use Modules\User\Entities\User;

class UserHasRegistered
{
    public $user;

    public function __construct(User  $user)
    {
        $this->user = $user;
    }
}
