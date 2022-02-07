<?php

namespace App\Http\Resources;

use Advoor\NovaEditorJs\NovaEditorJs;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class LayoutStoryLabResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $subtitle = NovaEditorJs::generateHtmlOutput(json_decode($this->subtitle));

        $mainJson = [];
        if (isset($this->shortcut)) {
            foreach (json_decode($this->shortcut) as $item) {
                switch ($item) {
                    case "/recherche?query=AR":
                        $jsonItem = [ "name" => "AR", "url" => "/recherche?query=AR" ];
                        break;
                    case "/recherche?query=VR":
                        $jsonItem = [ "name" => "VR", "url" => "/recherche?query=VR" ];
                        break;
                    case "/recherche?query=Les%20prim%C3%A9s":
                        $jsonItem = [ "name" => "Les primés", "url" => "/recherche?query=Les%20prim%C3%A9s" ];
                        break;
                    case "/recherche?query=fiction":
                        $jsonItem = [ "name" => "Fiction", "url" => "/recherche?query=fiction" ];
                        break;
                    case "/recherche?query=animation":
                        $jsonItem = [ "name" => "Animation", "url" => "/recherche?query=animation" ];
                        break;
                    case "/recherche?query=documentaires":
                        $jsonItem = [ "name" => "Documentaires", "url" => "/recherche?query=documentaires" ] ;
                        break;
                    case "/recherche?query=Immersion":
                        $jsonItem = [ "name"=> "Immersion", "url" => "/recherche?query=Immersion" ];
                        break;
                }
                $mainJson[] = $jsonItem;
            }
        }

        $agendaPosts = [];
        $today = Carbon::today();
        for ($n = 1; $n <= 6; $n++) {
            $article = $this->{'agenda_insert' . $n};
            $startDate = $this->{'agenda_insert' . $n . '_startDate'};
            $endDate = $this->{'agenda_insert' . $n . '_endDate'};
            $description = $this->{'agenda_insert' . $n . '_Description'};
            if (!empty($article) && Carbon::parse($endDate)->greaterThanOrEqualTo($today)) {
                array_push($agendaPosts, [
                    'article' => $article,
                    'startDate' => $startDate,
                    'endDate' => $endDate,
                    'description' => $description,
                ]);
            }
        }
        usort($agendaPosts, function($postA, $postB) {
            return Carbon::parse($postA['startDate'])->lessThan(Carbon::parse($postB['startDate'])) ? -1 : 1;
        });

        $participatePosts = [];
        for ($n = 1; $n <= 3; $n++) {
            $post = $this->{'participate_insert' . $n};
            if (!empty($post)) {
                array_push($participatePosts, [
                    'article' => self::parseMorph($post),
                    'description' => $this->{'participate_insert' . $n . '_Description'},
                    'button' => $this->{'participate_insert' . $n . '_Button'},
                ]);
            }
        }

        return [
            'id' => $this->id,
            'type' => 'layouts',
            'lang' => $request->lang,
            'data' => [
                'name' => $this->name,
                'shortcut' => $mainJson,
                'subtitle' => $subtitle,
                'primary' => [
                    'block1' => self::parseMorph($this->block1),
                    'block2' => self::parseMorph($this->block2),
                    'block3' => self::parseMorph($this->block3),
                    'block4' => self::parseMorph($this->block4),
                ],
                'coProduction' => [
                    'title' => $this->coProdTitle,
                    'subtitle' => $this->coProdSubTitle,
                ],
                'agenda' => [
                    'title' => $this->agendaTitle,
                    'subtitle' => $this->agendaSubTitle,
                    'posts' => $agendaPosts
                ],
                'participate' => [
                    'title' => $this->participateTitle,
                    'subtitle' => $this->participateSubTitle,
                    'posts' => $participatePosts,
                ],
                'archive' => [
                    'title' => $this->archiveTitle,
                    'subtitle' => $this->archiveSubTitle,
                ]
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
}
