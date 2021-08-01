<?php

return [
    'admin.ebooks' => [
        'index' => 'ebook::permissions.index',
        'create' => 'ebook::permissions.create',
        'edit' => 'ebook::permissions.edit',
        'destroy' => 'ebook::permissions.destroy',
    ],
    'admin.reportedebooks' => [
        'index' => 'ebook::permissions.reportedindex',
        'destroy' => 'ebook::permissions.reporteddestroy',
    ],
];
