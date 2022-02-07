<?php

namespace App\Nova\Filemanager;

use Infinety\Filemanager\Http\Services\AbstractNamingStrategy;
use Illuminate\Http\UploadedFile;

class CustomNamingStrategy extends AbstractNamingStrategy
{
    public function name(string $currentFolder, UploadedFile $file) : string
    {
        $filename = $file->getClientOriginalName();


        while ($this->storage->has($currentFolder.'/'.$filename)) {
            $filename = sprintf(
                '%s_%s.%s',
                pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                str_random(7),
                $file->getClientOriginalExtension()
            );
        }

        $filename = str_replace(' ', '_', $filename);
        return $filename;
    }
}
