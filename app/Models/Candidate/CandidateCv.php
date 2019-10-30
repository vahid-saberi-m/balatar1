<?php

namespace App\Models\Candidate;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CandidateCv
 * @package App\Models
 * @property int candidate_id
 * @property string cv
 * @property string file_name
 */

class CandidateCv extends Model
{
    protected $fillable = ['candidate_id','cv','file_name'];

    public function candidate(){
        return $this->belongsTo('App\Models\Candidate\Candidate', 'candidate_id');
    }}
