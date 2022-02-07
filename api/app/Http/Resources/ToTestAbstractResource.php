<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

use App\Models\States\Category\Article;
use App\Models\States\Category\External;
use App\Models\States\Category\Contribution;
use App\Models\Heading;

use App\Http\Resources\TagResource;
use App\Http\Resources\HeadingResource;
use Advoor\NovaEditorJs\NovaEditorJs;

class ToTestAbstractResource extends JsonResource
{
    public function toArray($request)
    {
        $lang = $request->lang;

        $time = $this->time
        ? self::convertToHoursMins(Carbon::parse($this->time)->format('H:i'))
        : null;

        $picto = isset($this->pictogram)
        ? [ 'image' => $this->pictogram->image, 'name' => $this->pictogram->title ]
        :null;

        $sponsor = isset($this->sponsor)
        ? [ 'image' => $this->sponsor->logo, 'name' => $this->sponsor->name ]
        :null;

        return [
            'id' => $this->id,
            'type' => self::interpolateType(get_class($this->resource)),
            'category' => $this->category,
            'lang' => $lang,
            'position' => $this->sort_order,
            'slug' => $this->slug,
            'data' => [
                'title' => $this->title,
                'excerpt' => $this->excerpt,
                'featured' => $this->featured,
                'featuredalt' => $this->featuredalt,
                'url' => $this->url,
                'heading' => new HeadingResource(Heading::getClass($this->heading)),
                'type' => $this->type,
                'time' => $time,
                'published_at' => $this->published_at,
                ],
            'pictogram' => $picto,
            'sponsor' => $sponsor,
            'tags' => [
                'data' => TagResource::collection($this->tags)
            ],
            'meta' => [
                'slug' => $this->getTranslations('slug')
            ],
        ];
    }

    private static function convertToHoursMins($time)
    {
        $parts = explode(':', $time);
        $minutes = $parts[0]*60+$parts[1];
        return $minutes;
    }

    private static function interpolateType($class)
    {
        if($class === \App\Models\Test::class) return 'tests';
        return 'posts';
    }
}
