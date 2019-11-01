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
        'user_id',
        'job_post_id',
        'application_id',
        'rate',
        'job_post_rating_field'
    ];

    public function jobPost()
    {
        return $this->belongsTo('App\Models\JobPost\JobPost', 'job_post_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User\User', 'user_id');
    }

    public function jobPostRatingField()
    {
        return $this->belongsTo('App\Models\JobPost\JobPostRatingField', 'job_post_rating_field');
    }

    public function application()
    {
        return $this->belongsTo('App\Models\Application\Application', 'application_id');
    }

    public function applicationComment()
    {
        return $this->belongsTo('App\Models\Application\ApplicationComment', 'application_comment_id');
    }
}
