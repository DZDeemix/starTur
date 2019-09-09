<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SkiResort extends Model
{
    public $timestamps = false;
    protected $table = 'ski_resort';
    protected $fillable = [
        'title',
        'lift_count_bugel',
        'lift_count_sit',
        'lift_count_ropeway',
        'height_diff', 'track_length',
        'start_season_date',
        'end_season_date',
        'slug',
    ];
    
    
    public function getStartSeasonDateAttribute($value)
    {
        return $value;
    }
    
    public function setStartSeasonDateAttribute($value)
    {
        $date = Carbon::createFromLocaleIsoFormat('D MMMM', 'ru', mb_strtolower($value));
        $this->attributes['start_season_date'] = $date->isoFormat('YYYY-MM-DD');
    }
    
    public function getEndSeasonDateAttribute($value)
    {
        return $value;
    }
    
    public function setEndSeasonDateAttribute($value)
    {
        $date = Carbon::createFromLocaleIsoFormat('D MMMM', 'ru', mb_strtolower($value));
        $this->attributes['end_season_date'] = $date->isoFormat('YYYY-MM-DD');
    }
    
    
}
