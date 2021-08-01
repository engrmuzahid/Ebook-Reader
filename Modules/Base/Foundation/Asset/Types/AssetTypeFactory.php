<?php

namespace Modules\Base\Foundation\Asset\Types;

use InvalidArgumentException;

class AssetTypeFactory
{
    /**
     * @param $asset
     * @return \Modules\Base\Foundation\Asset\Types\AssetType
     *
     * @throws \InvalidArgumentException
     */
    public function make($asset)
    {
        $typeClass = 'Modules\Base\Foundation\Asset\Types\\' . ucfirst(key($asset)) . 'Asset';

        if (! class_exists($typeClass)) {
            throw new InvalidArgumentException("Asset Type Class [{$typeClass}] not found");
        }

        return new $typeClass(
            $asset[key($asset)]
        );
    }
}
