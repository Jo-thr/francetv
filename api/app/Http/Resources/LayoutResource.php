<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PostAbstractResource;
use App\Http\Resources\MetaMediaResource;
use App\Http\Resources\TestAbstractResource;

class LayoutResource extends JsonResource
{


    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => 'layouts',
            'lang' => $request->lang,
            'data' => [
                'name' => $this->name,
                'description' => $this->description,
                'title' => $this->title,
                'background' => $this->background,
                'underline' => $this->underline,
                'font_black' => $this->font_black,
                'primary' => [
                    'block1' => self::parseMorph($this->block1),
                    'title' => $this->block1title,
                    'img' => $this->block1img,
                    'imgalt' => $this->block1imgalt,
                ],
                'secondary' => $this->interpolateBlocks(),
                'event' => self::parseEvent($this),
            ]
        ];
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

    private function interpolateBlocks(){
        $secondary = [];

        $secondary = [
            'block2' => self::parseMorph($this->block2),
            'block2title' => $this->block2title,
            'block3' => self::parseMorph($this->block3),
            'block3title' => $this->block3title,
            'aside' => self::position($this->type),
            "block3img" => $this->block3img,
            "block3imgalt" => $this->block3imgalt,
        ];

        if($this->name === 'narrative-research' || $this->name === 'tests'){
            return $secondary;
        } else{
            if(isset($this->block2) && isset($this->block3)){
                return $secondary;
            }
        }
        return [];

    }

    private static function position($type)
    {
        switch ($type) {
            case 'home':
            case 'narrative':
            case 'main':
            case 'main':
                return false;
            case 'tests':
                return true;
            default:
                return false;
        }
    }

    private static function parseEvent($resource)
    {
        if($resource->event_mode)
        {
            return [
                'title' => $resource->getTranslation('event_title', request()->lang),
                'iframe' => $resource->iframe,
                'twitter' => $resource->iframe_twitter,
            ];
        }

        return false;
    }
}
