<?php

namespace App\Models\Application;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CvFolder
 * @package App\Models
 *
 * @property JobPost jobPost
 * @property string name
 * @property int user_id
 * @property int company_id
 * @property int job_post_id
 * @property Text email_template
 * @property int sort
 */
class CvFolder extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'sort',
        'name',
        'user_id',
        'job_post_id',
        'company_id',
        'email_template'
    ];

    public function users(){
        return $this->belongsToMany('App\Models\User\User', 'cv_folder_user' );
    }
    public function jobPost(){
        return $this->belongsTo('App\Models\JobPost\JobPost');
    }
    public function company(){
        return $this->belongsTo('App\Models\Company\Company');
    }
    public function applications(){
        return $this->hasMany('App\Models\Application\Application');
    }
}
