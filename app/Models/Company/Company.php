<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Company
 * @package App\Models
 *
 * @property int id
 * @property string name
 * @property string company_size
 * @property string slogan
 * @property string website
 * @property string logo
 * @property text message_title
 * @property text message_content
 * @property string main_photo
 * @property text about_us
 * @property text why_us
 * @property string recruiting_steps
 * @property string address
 * @property string email
 * @property integer phone_number
 * @property string location
 * @property boolean is_live
 * @property mixed jobPosts
 *
 */
class Company extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'company_size',
        'slogan',
        'website',
        'logo',
        'message_title',
        'message_content',
        'main_photo',
        'about_us',
        'why_us',
        'recruiting_steps',
        'address',
        'email',
        'phone_number',
        'location',
        'package_id',
        'is_live'
    ];
    public function package()
    {
        return $this->belongsTo('App\Models\Package\Package', 'package_id');
    }

    public function packageUsage()
    {
        return $this->hasOne('App\Models\Package\PackageUsage', 'company_id');
    }
    public function users(){
        return $this->hasMany('App\Models\User\User');
    }
    public function jobPosts(){
        return $this->hasMany('App\Models\JobPost\JobPost', 'company_id');
    }
    public function events()
    {
        return $this->hasMany('App\Models\Company\Event');
    }
    public function jobPostRatingField()
    {
        return $this->hasMany('App\Models\JobPost\JobPostRatingField');
    }
}
