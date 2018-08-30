<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageUsage extends Model
{
    protected $fillable=[
        'company_id',
        'package_id',
        'daily_cv_view',
        'monthly_cv_view',
        'active_job_post_count',
        'expiration_date'
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
