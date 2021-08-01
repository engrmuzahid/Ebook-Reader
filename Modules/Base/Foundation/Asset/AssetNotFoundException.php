<?php

namespace Modules\Base\Foundation\Asset;

use Exception;

class AssetNotFoundException extends Exception
{
    public static function make($asset)
    {
        return new static("Asset [$asset] not found.");
    }
}
