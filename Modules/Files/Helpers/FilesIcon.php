<?php

namespace Modules\Files\Helpers;

class FilesIcon
{
   private static $icons = [
        'file' => 'fas fa-file',
        'image' => 'far fa-file-image',
        'audio' => 'far fa-file-audio',
        'video' => 'far fa-file-video',
        'word' => 'fas fa-file-word',
        'powerpoint' => 'fas fa-file-powerpoint',
        'excel' => 'fas fa-file-excel',
        'code' => 'fas fa-file-code',
        'csv' => 'fas fa-file-csv',
        'pdf' => 'far fa-file-pdf',
        'zip' => 'fas fa-file-archive',
        'vnd.rar' => 'fas fa-file-archive',
        'x-tar' => 'fas fa-file-archive',
        'gzip' => 'fas fa-file-archive',
        'x-bzip' => 'fas fa-file-archive',
        'x-7z-compressed' => 'fas fa-file-archive',
        
    ];

    public static function getIcon($mime)
    {
        list($type, $subtype) = explode('/', $mime);

        if (array_key_exists($subtype, static::$icons)) {
            return static::$icons[$subtype];
        }
        
        if (array_key_exists($type, static::$icons)) {
            return static::$icons[$type];
        }
        
        return static::$icons['file'];
    }
}
