<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        return $this->hasMany('App\Models\Company');
    }

    public function packageUsages()
    {
        return $this->hasMany('App\Models\package_usage');
    }
}
