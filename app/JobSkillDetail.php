<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobSkillDetail extends Model
{
    protected $guarded = ['id'];

    /*----------  RELASI TABLE  ----------*/
    public function skill()
    {
        return $this->belongsTo(Skill::class ,'skill_id');
    }
}
