<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Define which assets will be available through the asset manager
    | These assets are registered on the asset manager.
    |--------------------------------------------------------------------------
    */
    'all_assets' => [
        'admin.files.css' => ['module' => 'files:admin/css/files.css'],
        'admin.files.js' => ['module' => 'files:admin/js/files.js'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Define which default assets will always be included in all pages
    | through the asset pipeline.
    |--------------------------------------------------------------------------
    */
    'required_assets' => [],
];
