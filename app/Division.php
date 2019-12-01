<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $guarded = ['id'];

    /** VALIDATE **/
    public static $rules = [
        'name' => 'required|max:45|unique:divisions,name',
    ];

    public static function rule_edit($id)
    {
        return [
            'name' => 'required|max:45|unique:divisions,name,' . $id
        ];
    }
}
