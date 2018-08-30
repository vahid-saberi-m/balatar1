<?php

use Faker\Generator as Faker;

$factory->define(App\Models\PackageUsage::class, function (Faker $faker) {
    $companyId= $faker->randomElement(\App\Models\Company::all()->pluck('id')->toArray());
    $company= App\Models\Company::find($companyId);
    $package=$company->package;
    $dailyCvView=$package->first()->daily_cv_view;
    return [
        'company_id'=>$company,
        'package_id'=>$package,
        'daily_cv_view'=>$faker->numberBetween($min=0 , $max=$dailyCvView ),
        'monthly_cv_view'=>$faker->numberBetween($min=$dailyCvView , $max=$package->monthly_cv_view ),
        'active_job_post_count'=>$company->jobPosts->count(),
        'expiration_date'=>$faker->dateTimeBetween($min='now', $max='+ 30 days')
    ];
});
