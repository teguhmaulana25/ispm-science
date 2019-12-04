<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $guarded = ['id'];

    /** VALIDATE **/
    public static $rules = [
        'name' => 'required|max:45',
    ];

    public static function rule_edit($id)
    {
        return [
            'name' => 'required|max:45'
        ];
    }

    /*----------  RELASI TABLE  ----------*/
    public function division()
    {
        return $this->belongsTo(Division::class ,'division_id');
    }
}
