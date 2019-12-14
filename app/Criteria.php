<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    protected $guarded = ['id'];

    /** VALIDATE **/
    public static $rules = [
        'name' => 'required|max:45|unique:criterias,name',
        'percentage' => 'required',
        'type' => 'required',
        'step' => 'required',
    ];

    public static function rule_edit($id)
    {
        return [
            'name' => 'required|max:45|unique:criterias,name,' . $id,
            'percentage' => 'required',
            'type' => 'required',
            'step' => 'required',
        ];
    }

    public function criteriaDetail() {
        return $this->hasMany('App\CriteriaDetail');
    }
}
