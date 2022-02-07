<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use App\Models\Heading;
use Advoor\NovaEditorJs\NovaEditorJs;

class PostResource extends JsonResource
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

        $departement = isset($this->user->departement)
        ? $this->user->departement->name
        : '';

        $user = isset($this->user)
        ? $this->user->fullname
        : '';

        $time = $this->time
        ? self::convertToHoursMins(Carbon::parse($this->time)->format('H:i'))
        : null;

        $author = isset($this->author)
        ? explode('; ', $this->author)
        : [ 'name' => $user, 'departement' => $departement ];

        $picto = isset($this->pictogram)
        ? [ 'image' => $this->pictogram->image, 'name' => $this->pictogram->title ]
        :null;

        if (!$this->v2) {
            if ($lang === 'en') {
                $content = json_decode($this->content_en);
                if (empty($content->blocks)) {
                    $lang = 'fr';
                    $request->lang = 'fr';
                }
            }

            $content = $lang === 'fr'
            ? NovaEditorJs::generateHtmlOutput(json_decode($this->content_fr))
            : NovaEditorJs::generateHtmlOutput(json_decode($this->content_en));
        } else {
            if ($lang === 'en') {
                $topContent = json_decode($this->content_en_v2_top);
                $bottomContent = json_decode($this->content_en_v2_bottom);
                if (empty($topContent->blocks) && empty($bottomContent->blocks)) {
                    $lang = 'fr';
                    $request->lang = 'fr';
                }
            }

            $content = $lang === 'fr' ?
                [
                    'top' => NovaEditorJs::generateHtmlOutput(json_decode($this->content_fr_v2_top)),
                    'bottom' => NovaEditorJs::generateHtmlOutput(json_decode($this->content_fr_v2_bottom)),
                ]
                :
                [
                    'top' => NovaEditorJs::generateHtmlOutput(json_decode($this->content_en_v2_top)),
                    'bottom' => NovaEditorJs::generateHtmlOutput(json_decode($this->content_en_v2_bottom)),
                ];
        }

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

        $carousel = [];
        for ($n = 1; $n <= 10; $n++) {
            array_push($carousel, [
                'index' => $n,
                'content' => $this->{'carousel_' . $n},
                'legend' =>  $this->{'carousel_' . $n . '_legend'}
            ]);
        }
        $otherProjects = [];
        for ($n = 1; $n <= 4; $n++) {
            $otherProject = $this->{'other_project_' . $n};
            if (!empty($otherProject)) {
                array_push($otherProjects, self::parseMorph($otherProject));
            }
        }

        return [
            'id' => $this->id,
            'type' => 'posts',
            'category' => $this->category,
            'lang' => $lang,
            'position' => $this->sort_order,
            'slug' => $this->slug,
            'version' => $this->v2 ? 'v2' : 'v1',
            'data' => [
                'title' => $this->title,
                'content' => $content,
                'excerpt' => $this->excerpt,
                'featured' => $this->featured,
                'featuredalt' => $this->featuredalt,
                'url' => $this->url,
                'heading' => new HeadingResource(Heading::getClass($this->heading)),
                'type' => $this->type,
                'time' => $time,
                'claps' => $this->claps,
                'published_at' => $this->published_at,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'iframe' => $this->iframe,
                'video' => $this->video,
                'age' => $age,
                'flag' => $this->flag,
                'press' => $this->press,
                'illustration' => [
                    'image' => $this->featured_illustration,
                    'video' => $this->video_illustration,
                    'video_square' => $this->video_square,
                    'video_alt' => $this->video_alt,
                    ],
                'other_projects' => $otherProjects,
                'carousel' => $carousel,
                'credits' => [
                    'fr' => NovaEditorJs::generateHtmlOutput(json_decode($this->credits_fr)),
                    'en' => NovaEditorJs::generateHtmlOutput(json_decode($this->credits_en)),
                ],
                'social' => [
                    'apple' => [
                        'url' => $this->apple_url,
                        'rating' => $this->apple_rating,
                    ],
                    'google_url' => [
                        'url' => $this->google_url,
                        'rating' => $this->google_rating,
                    ],
                    'oculus_url' => [
                        'url' => $this->oculus_url,
                        'rating' => $this->oculus_rating,
                    ],
                    'custom_1' => [
                        'name' => $this->name_store_1,
                        'url' => $this->url_store_1,
                        'logo' => $this->logo_store_1,
                        'rating' => $this->rating_store_1,
                    ],
                    'custom_2' => [
                        'name' => $this->name_store_2,
                        'url' => $this->url_store_2,
                        'logo' => $this->logo_store_2,
                        'rating' => $this->rating_store_2,
                    ],
                ],
            ],
            'author' => $author,
            'pictogram' => $picto,
            'speakers' => $this->when($this->speakers, explode('; ', $this->speakers)),
            'tags' => [
                'data' => TagResource::collection($this->tags),
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

    private static function parseMorph($morphObj)
    {
        if (is_null($morphObj)) {
            return null;
        }
        if (get_class($morphObj) === 'App\Models\MetaMedia') {
            return new MetaMediaResource($morphObj);
        } elseif (get_class($morphObj) === 'App\Models\Test') {
            return new TestAbstractResource($morphObj);
        }
        return new PostAbstractResource($morphObj);
    }
}
