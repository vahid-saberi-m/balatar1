<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Application
 * @package App\Models
 * @property  'candidate_id',
 * @property 'job_post_id',
 * @property 'is_seen',
 * @property 'cv_id',
 * @property 'cv_folder_id'
 */

class Application extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'candidate_id',
        'job_post_id',
        'is_seen',
        'cv_id',
        'cv_folder_id'

    ];
    public function cvFolder(){
        return $this->belongsTo('App\Models\CvFolder', 'cv_folder_id');
    }
    public function candidate(){
        return $this->belongsTo('App\Models\Candidate', 'candidate_id');
    }
    public function jobPost(){
        return $this->belongsTo('App\Models\JobPost','job_post_id');
    }
    public function cvUser(){
        return $this->belongsTo('App\Models\CvUser');
    }
    protected $dates = ['deleted_at'];
}
