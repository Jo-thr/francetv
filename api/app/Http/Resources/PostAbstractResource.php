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

class PostAbstractResource extends JsonResource
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

        switch ($this->age) {
            case 'all':
                $age = [
                    'fr' => 'Tous publics',
                    'en' => 'All audiences',
                ];
                break;
            case 'adult':
                $age = [
                    'fr' => '+16 ans',
                    'en' => '+16 years',
                ];
                break;
            case 'young':
                $age = [
                    'fr' => 'Jeunesse',
                    'en' => 'Youth',
                ];
                break;
            default:
                $age = null;
                break;
        }

        return [
            'id' => $this->id,
            'type' => 'posts',
            'category' => $this->category,
            'lang' => $lang,
            'position' => $this->sort_order,
            'slug' => $this->slug,
            'data' => [
                'title' => $this->title,
                'excerpt' => $this->excerpt,
                'featured' => $this->featured,
                'featuredalt' => $this->featuredalt,
                'video' => $this->video,
                'video_square' => $this->video_square,
                'video_alt' => $this->video_alt,
                'age' => $age,
                'url' => $this->url,
                'heading' => new HeadingResource(Heading::getClass($this->heading)),
                'type' => $this->type,
                'time' => $time,
                'published_at' => $this->published_at,
                ],
            'pictogram' => $picto,
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
}
