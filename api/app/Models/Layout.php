<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;
use Spatie\Translatable\HasTranslations;

use App\Models\States\LayoutType\Main;
use App\Models\States\LayoutType\Narrative;
use App\Models\States\LayoutType\Tests;
use App\Models\States\LayoutType\Home;
use App\Models\States\LayoutType\MetaMedia;

use Spatie\ResponseCache\Facades\ResponseCache;

class Layout extends Model
{
    use Uuids, HasTranslations;

    public $translatable = [
        'block1imgalt',
        'block1title',
        'block2title',
        'block3title',
        'description',
        'block3imgalt',
        'title',
        'event_title',
    ];

    public $fillable = [
        'block1title',
        'block2title',
        'block1imgalt',
        'block1img',
        'block1_type',
        'block2_type',
        'block3_type',
        'block4_type',
        'name',
        'label',
        'type'
    ];

    public static $states = [
        Main::class,
        Narrative::class,
        Tests::class,
        MetaMedia::class,
        Home::class,
    ];

    protected $casts = [
        'agenda_insert1_startDate' => 'date',
        'agenda_insert1_endDate' => 'date',
        'agenda_insert2_startDate' => 'date',
        'agenda_insert2_endDate' => 'date',
        'agenda_insert3_startDate' => 'date',
        'agenda_insert3_endDate' => 'date',
        'agenda_insert4_startDate' => 'date',
        'agenda_insert4_endDate' => 'date',
        'agenda_insert5_startDate' => 'date',
        'agenda_insert5_endDate' => 'date',
        'agenda_insert6_startDate' => 'date',
        'agenda_insert6_endDate' => 'date',
        'coProdTitle' => 'json',
        'coProdSubTitle' => 'json',
        'agendaTitle' => 'json',
        'agendaSubTitle' => 'json',
        'participateTitle' => 'json',
        'participateSubTitle' => 'json',
        'agenda_insert1_Description' => 'json',
        'agenda_insert2_Description' => 'json',
        'agenda_insert3_Description' => 'json',
        'agenda_insert4_Description' => 'json',
        'agenda_insert5_Description' => 'json',
        'agenda_insert6_Description' => 'json',
        'participate_insert1_Description' => 'json',
        'participate_insert1_Button' => 'json',
        'participate_insert2_Description' => 'json',
        'participate_insert2_Button' => 'json',
        'participate_insert3_Description' => 'json',
        'participate_insert3_Button' => 'json',
        'archiveTitle' => 'json',
        'archiveSubTitle' => 'json',
    ];

    public function block1()
    {
        return $this->morphTo(__FUNCTION__, 'block1_type', 'block1_id');
    }

    public function block2()
    {
        return $this->morphTo(__FUNCTION__, 'block2_type', 'block2_id');
    }

    public function block3()
    {
        return $this->morphTo(__FUNCTION__, 'block3_type', 'block3_id');
    }

    public function block4()
    {
        return $this->morphTo(__FUNCTION__, 'block4_type', 'block4_id');
    }

    public function participate_insert1()
    {
        return $this->morphTo(__FUNCTION__, 'participate_insert1_type', 'participate_insert1_id');
    }

    public function participate_insert2()
    {
        return $this->morphTo(__FUNCTION__, 'participate_insert2_type', 'participate_insert2_id');
    }

    public function participate_insert3()
    {
        return $this->morphTo(__FUNCTION__, 'participate_insert3_type', 'participate_insert3_id');
    }

    public function agenda_insert1()
    {
        return $this->morphTo(__FUNCTION__, 'agenda_insert1_type', 'agenda_insert1_id');
    }

    public function agenda_insert2()
    {
        return $this->morphTo(__FUNCTION__, 'agenda_insert2_type', 'agenda_insert2_id');
    }

    public function agenda_insert3()
    {
        return $this->morphTo(__FUNCTION__, 'agenda_insert3_type', 'agenda_insert3_id');
    }

    public function agenda_insert4()
    {
        return $this->morphTo(__FUNCTION__, 'agenda_insert4_type', 'agenda_insert4_id');
    }

    public function agenda_insert5()
    {
        return $this->morphTo(__FUNCTION__, 'agenda_insert5_type', 'agenda_insert5_id');
    }

    public function agenda_insert6()
    {
        return $this->morphTo(__FUNCTION__, 'agenda_insert6_type', 'agenda_insert6_id');
    }

    public function postsToExclude()
    {
        $id1 = $this->block1->id ?? null;
        $id2 = $this->block2->id ?? null;
        $id3 = $this->block3->id ?? null;
        $id4 = $this->block4->id ?? null;

        return array_filter([ $id1, $id2, $id3, $id4 ]);
    }

    protected static function booted()
    {
        static::updated(function ($layout) {
            ResponseCache::clear();
        });
    }
}
