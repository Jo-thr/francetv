<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SearchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'lang' => 'fr',
            'type' => self::parseResourceClass($this->resource),
            'category' => $this->category,
            'heading' => $this->heading,
            'data' => [
                'type' => $this->type,
                'title' => $this->title,
                'url' => $this->url,
                'featured' => $this->featured ?? null,
                'image' => $this->image ?? null,
                'description' => $this->description,
                'exceprt' => $this->exceprt,
                'published_at' => $this->published_at ?? $this->start_at,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'meta' => [
                'slug' => $this->when(
                    self::parseResourceClass($this->resource) !== 'metamedias',
                    function () {
                        return $this->getTranslations('slug');
                    }
                ),
            ]
        ];
    }

    private static function parseResourceClass($resource)
    {
        return strtolower(substr(get_class($resource), 11)).'s';
    }
}
