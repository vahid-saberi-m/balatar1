<?php

namespace App\Models\JobPost;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Company
 * @package App\Models
 *
 * @property int id
 * @property int company_id
 * @property int user_id
 * @property string title
 * @property string summary
 * @property string description
 * @property string requirements
 * @property string benefits
 * @property boolean approval
 * @property string location
 * @property Date publish_date
 * @property int cv_views
 * @property boolean is_active
 * @property boolean email_template

 *
 */


class JobPost extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'job_posts';

    protected $fillable = [
        'company_id',
        'user_id',
        'title',
        'summary',
        'description',
        'requirements',
        'benefits',
        'approval',
        'location',
        'publish_date',
        'expiration_date',
        'cv_views',
        'is_active',
        'email_template'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User\User');
    }
    public function company()
    {
        return $this->belongsTo('App\Models\Company\Company', 'company_id');
    }
    public function cvFolders()
    {
        return $this->hasMany('App\Models\Application\CvFolder');
    }
    public function applications()
    {
        return $this->hasMany('App\Models\Application\Application');
    }
    public function questions()
    {
        return $this->hasMany('App\Models\JobPost\Question');
    }
    public function applicationRatings()
    {
        return $this->hasMany('App\Models\Application\ApplicationRating');
    }
    public function jobPostRatingField()
    {
        return $this->hasMany('App\Models\JobPost\JobPostRatingField');
    }
}
