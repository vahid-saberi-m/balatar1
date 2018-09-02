<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User
 * @package App\Models
 * @property int company_id
 * @property string name
 * @property string email
 * @property string password
 * @property string role
 * @property string position
 * @property string image
 * @property boolean is_approved
 */
class User extends Authenticatable
{
    use Notifiable;
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

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

}
