<?php

use Faker\Generator as Faker;

$factory->define(App\Models\PackageUsage::class, function (Faker $faker) {
    $companyId= $faker->randomElement(\App\Models\Company::all()->pluck('id')->toArray());
    $company= App\Models\Company::find($companyId);
    $package=$company->package;
    $dailyCvView=$package->first()->daily_cv_view;

    return [
        'company_id'=>$company->id,
        'package_id'=>$package->id,
        'daily_cv_view_left'=>$faker->numberBetween($min=0 , $max=$dailyCvView ),
        'monthly_cv_view_left'=>$faker->numberBetween($min=$dailyCvView , $max=$package->monthly_cv_view ),
        'active_job_post_left'=>$company->jobPosts->count(),
        'expires_at'=>$faker->dateTimeBetween($min='now', $max='+ 30 days')
    ];
});

