<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $guarded = ['id'];

    public function candidateDetail() {
        return $this->hasMany('App\CandidateDetail');
    }
}
