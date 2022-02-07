<?php

namespace App\Jobs;

use Illuminate\Filesystem\FilesystemAdapter;
use ImageOptimizer;
use File;

class ResizeImages
{
    protected $storage;

    protected $filePath;

    public function __construct(FilesystemAdapter $storage, String $filePath)
    {
        $this->storage = $storage;
        $this->filePath = $filePath;
    }

    public function handle()
    {
        $img = \Spatie\Image\Image::load(storage_path('app/public/'.$this->filePath));
        if ($img->getWidth() > 1800) {
            $img->width(1800);
            $img->save();
        }
        if ($img->getHeight() > 1000) {
            $img->height(1000);
            $img->save();
        }
        ImageOptimizer::optimize(storage_path('app/public/'.$this->filePath));
    }
}
