<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $guarded = ['id'];

    /** VALIDATE **/
    public static $rules = [
        'division_id' => 'required',
        'name' => 'required|max:45',
    ];

    public static function rule_edit($id)
    {
        return [
            'division_id' => 'required',
            'name' => 'required|max:45'
        ];
    }

    /*----------  RELASI TABLE  ----------*/
    public function division()
    {
        return $this->belongsTo(Division::class ,'division_id');
    }
}
