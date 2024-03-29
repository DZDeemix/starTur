<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSkiResort;
use App\SkiResort;
use Illuminate\Http\Request;
use phpQuery;
use Illuminate\Support\Str;


class SkiResortController extends Controller
{
    public function resortParse() {
        $resort_all = SkiResort::orderBy('id', 'desc')->get()->toJson();
        //dd($resort_all);
        return view('resort', ['resort_all' => $resort_all]);
    }
    
    public function getResortParseData($id) {
        
        $html = file_get_contents('https://www.ski.ru/az/resort/'.$id);
        
        phpQuery::newDocument($html);
        
        $title = pq('.house-heading.small_village')->text();
        $lift_count_bugel = pq('li .ski-resort')->text();
        $lift_count_sit = pq('li .skiLift-resort')->text();
        $lift_count_ropeway = pq('li .wagon-resort')->text();
        $height_diff = $this->strCutLeft(pq('li.mountain-resort')->text());
    
        $mat = [];
        $track_length = pq('li.mountain-circle-resort')->text();
        if(preg_match("/[0-9]{0,9}/",$track_length,$mat)) {
            $track_length = $mat[0];
        };
        
        $season_date = $this->strCutLeft(pq('li.calendar-resort')->text());
        $season_date = $this->stringPrepare($season_date);
        $start_season_date = $season_date[0];
        $end_season_date = $season_date[1];
        
        $data = [
            'title' => !empty($title) ? $title : '',
            'lift_count_bugel' => !empty($lift_count_bugel) ? $lift_count_bugel : '',
            'lift_count_sit' => !empty($lift_count_sit) ? $lift_count_sit : '',
            'lift_count_ropeway' => !empty($lift_count_ropeway) ? $lift_count_ropeway : '',
            'height_diff' => !empty($height_diff) ? $height_diff : '',
            'track_length' => !empty($track_length) ? $track_length : '',
            'start_season_date' => !empty($start_season_date) ? $start_season_date : '',
            'end_season_date' => !empty($end_season_date) ? $end_season_date: '',
        ];
        phpQuery::unloadDocuments();
        
        return response()->json($data, 200);
    }
    
    public function stringPrepare ($string = false) {
        if (!empty($string)) {
            
            if (strpos($string,"-")) {
                $string = explode("-", $string);
                foreach ($string as &$date) {
                    $date = trim($date);
                }
                
                return $string;
            }
            return '';
        }
        return '';
    }
    
    public function strCutLeft($string) {
        if (substr_count($string,":") === 1) {
            return explode(":", $string)[1];
        }
        return $string;
    }
    
    public function saveResortParseData(StoreSkiResort $request) {
        
        $title= $request->input('title');
        $request->merge(['slug' => Str::slug($title)]);
        $resort = new SkiResort();
        $resort = $resort->updateOrCreate(['title' => $title], $request->all());
        
        return $resort->toJson();
    }
}

