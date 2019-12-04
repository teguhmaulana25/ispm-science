<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CriteriaDetail extends Model
{
    protected $guarded = ['id'];

    /** VALIDATE **/
    public static $rules = [
        'name' => 'required|max:45',
        'value' => 'required'
    ];

    public static function rule_edit($id)
    {
        return [
            'name' => 'required|max:45',
            'value' => 'required'
        ];
    }

    /*----------  RELASI TABLE  ----------*/
    public function criteria()
    {
        return $this->belongsTo(Criteria::class ,'criteria_id');
    }
}
