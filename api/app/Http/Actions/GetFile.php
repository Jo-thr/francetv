<?php

namespace App\Http\Actions;

use App\Http\Actions\Controller;
use File;
use Response;

/**
 * Get a file in the public storage
 */
class GetFile extends Controller
{
    public function __invoke(string $filename)
    {
        $path = storage_path('app/public/' . $filename);


        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}
