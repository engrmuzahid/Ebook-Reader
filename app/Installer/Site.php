<?php

namespace App\Installer;

use Modules\Setting\Entities\Setting;

class Site
{
    public function setup($data)
    {
        Setting::setMany([
            'translatable' => [
                'site_name' => $data['site_name'],
            ],
            'site_email' => $data['site_email'],
        ]);
    }
}
