<?php

namespace App\Models\Application;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Company
 * @package App\Models
 *
 * @property int id
 * @property int job_post_id
 * @property int application_id
 * @property int rate


 *
 */
class ApplicationRating extends Model
{
    use SoftDeletes;
    protected $table = 'application_ratings';
    protected $fillable = [
        'job_post_id',
        'application_id',
        'rate',
    ];
    public function jobPost(){
        return $this->belongsTo('App\Models\JobPost\JobPost', 'job_post_id');
    }
    public function application(){
        return $this->belongsTo('App\Models\Application\Application', 'application_id');
    }
}
