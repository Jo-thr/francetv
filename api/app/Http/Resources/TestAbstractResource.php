<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use Advoor\NovaEditorJs\NovaEditorJs;
use App\Http\Resources\TestCollection;

class TestAbstractResource extends JsonResource
{
    public function toArray($request)
    {
        $lang = $request->lang;

        $sponsor = isset($this->sponsor)
        ? [ 'image' => $this->sponsor->logo, 'name' => $this->sponsor->name ]
        :null;

        return [
            'id' => $this->id,
            'type' => 'tests',
            'lang' => $request->lang,
            'data' => [
                'title' => $this->title,
                'slug' => $this->slug,
                'status' => $this->status(),
                'featured' => $this->featured,
                'excerpt' => $this->excerpt,
                'featuredalt' => $this->featuredalt,
                'start_at' => $this->start_at,
                'end_at' => $this->end_at,
            ],
            'sponsor' => $sponsor,
            'meta' => [
                'slug' => $this->getTranslations('slug'),
            ],
        ];
    }
}
