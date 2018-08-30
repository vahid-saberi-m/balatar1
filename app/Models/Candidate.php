<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Candidate extends Model
{
    protected $fillable = [
        'phone',
        'email',
        'name',
        'company',
        'position',
        'experience',
        'education',
        'degree',
        'university'

    ];

    public function applications(){
        return $this->hasMany('App\Models\Application');
    }
    public function CandidateCVs(){
        return $this->hasMany('App\Models\CandidateCv');
    }
}
