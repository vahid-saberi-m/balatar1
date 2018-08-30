<?php

namespace App\Models;

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
        'package_id'
    ];
    public function package()
    {
        return $this->belongsTo('App\Models\Package', 'package_id');
    }

    public function packageUsages()
    {
        return $this->hasMany('App\Models\PackageUsage', 'package_id');
    }
    public function users(){
        return $this->hasMany('App\Models\User');
    }
    public function jobPosts(){
        return $this->hasMany('App\Models\JobPost', 'company_id');
    }
    public function events()
    {
        return $this->hasMany('App\Models\Event');
    }
}
