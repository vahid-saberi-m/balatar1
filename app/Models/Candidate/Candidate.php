<?php

namespace App\Models\Candidate;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Candidate
 * @package App\Models
 * @property int id
 * @property int phone
 * @property string email
 * @property string name
 * @property string company
 * @property string position
 * @property string experience
 * @property string education
 * @property string degree
 * @property string university
 */

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
        return $this->hasMany('App\Models\Application\Application');
    }
    public function candidateCvs(){
        return $this->hasMany('App\Models\Candidate\CandidateCv','candidate_id');
    }
}
