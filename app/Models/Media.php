<?php

namespace App\Models;

use Spatie\ImageOptimizer\OptimizerChain;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;
use ImageOptimizer;
class Media extends BaseMedia
{
    /**
     * optimizes the image path
     */
    public function optimize()
    {
        // OptimizerChain
        ImageOptimizer::optimize($this->getPath());
        // app(Spatie\ImageOptimizer\OptimizerChain::class)->optimize($this->getPath());
    }
}
