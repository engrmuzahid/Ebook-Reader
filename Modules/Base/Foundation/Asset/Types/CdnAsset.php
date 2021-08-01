<?php

namespace Modules\Base\Foundation\Asset\Types;

class CdnAsset implements AssetType
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function url()
    {
        return $this->path;
    }
}
