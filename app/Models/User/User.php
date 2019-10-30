<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 * @package App\Models
 * @property int id
 * @property int company_id
 * @property string name
 * @property string email
 * @property string password
 * @property string role
 * @property string position
 * @property string image
 * @property boolean is_approved
 *
 * @property Company company
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasRoles;
    use SoftDeletes;
    use HasApiTokens, Notifiable;
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id', 'name', 'email', 'password', 'role', 'position','image','is_approved'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function cvFolders()
    {
        return $this->belongsToMany('App\Models\CvFolder', 'cv_folder_user');
    }

    public function jobPosts()
    {
        return $this->hasMany('App\Models\JobPost');
    }

    public function applicationComments()
    {
        return $this->hasMany('App\Models\ApplicationComment');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }
    public function OauthAccessToken(){
        return $this->hasMany('\App\Models\OauthAccessToken','user_id');
    }

}
