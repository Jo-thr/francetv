<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use Advoor\NovaEditorJs\NovaEditorJs;
use App\Http\Resources\TagResource;

class TestResource extends JsonResource
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

        $departement = isset($this->user->departement)
        ? $this->user->departement->name
        : '';

        $user = isset($this->user)
        ? $this->user->fullname
        : '';

        $iframe = $lang === "fr"
        ? $this->iframe_test
        : $this->iframe_en;

        $sponsor = isset($this->sponsor)
        ? [ 'image' => $this->sponsor->logo, 'name' => $this->sponsor->name ]
        :null;

        if ($request->lang === 'fr') {
            $desktopTrigger = $this->desktop_trigger_fr;
            $mobileTrigger = $this->mobile_trigger_fr;
        }
        if ($request->lang === 'en') {
            $desktopTrigger = $this->desktop_trigger_en
            ? $this->desktop_trigger_en
            : $this->desktop_trigger_fr;

            $mobileTrigger = $this->mobile_trigger_en
            ? $this->mobile_trigger_en
            : $this->mobile_trigger_fr;
        }

        return [
            'id' => $this->id,
            'type' => 'tests',
            'lang' => $request->lang,
            'data' => [
                'title' => $this->title,
                'slug' => $this->slug,
                'content' => $content,
                'status' => $this->status(),
                'featured' => $this->featured,
                'excerpt' => $this->excerpt,
                'featuredalt' => $this->featuredalt,
                'shares' => $this->share,
                'votes' => $this->votes->count(),
                'tested' => $this->tested,
                'start_at' => $this->start_at,
                'published_at' => $this->start_at,
                'iframe' => $iframe,
                'end_at' => $this->end_at,
            ],
            'sponsor' => $sponsor,
            'tags' => [
                'data' => TagResource::collection($this->tags)
            ],
            'meta' => [
                'slug' => $this->getTranslations('slug'),
            ],
            'usabilla' =>  [
                'desktop_trigger' => $desktopTrigger,
                'mobile_trigger' => $mobileTrigger,
                'time' => $this->trigger_time,
            ],
        ];
    }
}
