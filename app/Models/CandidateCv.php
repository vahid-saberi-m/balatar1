<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CandidateCv extends Model
{
    protected $fillable = ['candidate_id','cv'];

    public function candidate(){
        return $this->belongsTo('App\Models\Candidate', 'candidate_id');
    }}
