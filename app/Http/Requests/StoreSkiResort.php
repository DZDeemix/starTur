<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSkiResort extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'lift_count_bugel' => 'required|numeric',
            'lift_count_sit' => 'required|numeric',
            'lift_count_ropeway' => 'required|numeric',
            'height_diff' => 'required|string|max:255',
            'track_length' => 'required|numeric',
            'start_season_date' => 'required|regex:/[0-9]{1,2} [а-яё]{3,20}/ui',
            'end_season_date' => 'required|regex:/[0-9]{1,2} [а-яё]{3,20}/ui',
        ];
    }
}
