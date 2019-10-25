<?php

namespace App\Models;

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
 */
class CvFolder extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'user_id',
        'job_post_id',
        'company_id',
        'email_template'
    ];

    public function users(){
        return $this->belongsToMany('App\Models\User', 'cv_folder_user' );
    }
    public function jobPost(){
        return $this->belongsTo('App\Models\JobPost');
    }
    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function applications(){
        return $this->hasMany('App\Models\Application');
    }
}
