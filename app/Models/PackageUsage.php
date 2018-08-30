<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageUsage extends Model
{
    protected $fillable=[
        'company_id',
        'package_id',
        'daily_cv_view_left',
        'monthly_cv_view_left',
        'active_job_post_left',
        'expires_at'
    ];
    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }
    public function package()
    {
        return $this->belongsTo('App\Models\Package');
    }
}
