<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HeadingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $lang = $request->lang;
        $heading = new $this->resource;

        return [
            'id' => $heading::$key,
            'type' => 'headings',
            'lang' => $lang,
            'data' => [
                'label' => $heading->label($lang),
                'slug' => $heading->slug($lang),
            ],
            'meta' => [
                'slug' => $heading->meta(),
            ]
        ];
    }
}
