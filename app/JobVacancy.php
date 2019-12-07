<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobVacancy extends Model
{
    protected $guarded = ['id'];

    /** VALIDATE **/
    public static $rules = [
        'division_id' => 'required',
        'title' => 'required|max:50',
        'description' => 'required',
        'start_date' => 'required',
        'end_date' => 'required'
    ];

    public static function rule_edit($id)
    {
        return [
            'division_id' => 'required',
            'title' => 'required|max:50',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ];
    }

    /*----------  RELASI TABLE  ----------*/
    public function division()
    {
        return $this->belongsTo(Division::class ,'division_id');
    }
}
