<?php

namespace Modules\Base\Events;

use Modules\Base\Foundation\Asset\Pipeline\AssetPipeline;

class FetchingAssets
{
    private $assetPipeline;

    public function __construct(AssetPipeline $assetPipeline)
    {
        $this->assetPipeline = $assetPipeline;
    }

    public function checkRoutes(array $routes)
    {
        foreach ($routes as $route) {
            if (preg_match("/{$route}/", request()->route()->getName())) {
                return true;
            }
        }

        return false;
    }

    public function requireAssets(array $assets)
    {
        return $this->assetPipeline->requireAssets($assets);
    }
}
