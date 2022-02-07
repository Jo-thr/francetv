<?php

namespace App\Helpers;

use App\Models\MetaMedia;

use Illuminate\Support\Facades\Http;
use Mtownsend\XmlToArray\XmlToArray;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\ResponseCache\Facades\ResponseCache;

class MetaMediaFetcher
{
    private static $endpoint = 'https://www.meta-media.fr/rss?feed=rss2&paged=';

    public static function fetch($nbPage, $truncate = false)
    {
        if ($truncate) {
            MetaMedia::truncate();
        }

        for ($i = 1; $i < $nbPage+1; $i++) {
            self::fetchAndSaveMetaMedia($i);
        }

        ResponseCache::clear();
    }

    private static function fetchAndSaveMetaMedia($page)
    {
        $xml = Http::get(self::$endpoint.$page)->body();
        $feed = XmlToArray::convert($xml);
        $articles = $feed['channel']['item'];

        $iterator = ($page-1)*10;

        foreach ($articles as $article) {
            $iterator++;
            $metaMedia = new MetaMedia;

            $image = isset($article['enclosure'])
                  ? $article['enclosure']["@attributes"]['url']
                  : '';

            $id = (string) Str::uuid();

            $metaMedia::insertOrIgnore(
                [
                  'id' => $id,
                  'sort_order' => $iterator,
                  'externalId' => explode('=', $article['guid']['@content'])[1],
                  'title' => html_entity_decode($article['title']),
                  'url' => $article['link'],
                  'description' => html_entity_decode($article['description']),
                  'published_at' => Carbon::parse($article['pubDate'])
                                          ->format('d M Y , H:i:s'),
                  'image' => $image,
                  'created_at' => now(),
                  'updated_at' => now()
              ]
            );
            if ($item = MetaMedia::find($id)) {
                $item->searchable();
            }
        }
    }
}
