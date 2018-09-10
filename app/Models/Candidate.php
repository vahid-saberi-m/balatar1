<?php

namespace App\Models;

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
        return $this->hasMany('App\Models\Application');
    }
    public function CandidateCVs(){
        return $this->hasMany('App\Models\CandidateCv');
    }
}
