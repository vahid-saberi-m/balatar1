<?php

namespace App\Models\Package;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Package
 * @package App\Models
 * @property string 'name',
 * @property int'daily_cv_view',
 * @property int'monthly_cv_view',
 * @property int'per_job_post_cv_view',
 * @property int'active_job_post_limit',
 * @property int'question_per_job_post_limit',
 * @property int'package_lifetime',
 * @property date job_post_lifetime_limit',
 * @property int'price'
 */

class Package extends Model
{
    protected $fillable =[
        'name',
        'daily_cv_view',
        'monthly_cv_view',
        'per_job_post_cv_view',
        'active_job_post_limit',
        'question_per_job_post_limit',
        'package_lifetime',
        'job_post_lifetime_limit',
        'price'
        ];
    public function companies()
    {
        return $this->hasMany('App\Models\Company\Company');
    }

    public function packageUsages()
    {
        return $this->hasMany('App\Models\Package\package_usage');
    }
}
