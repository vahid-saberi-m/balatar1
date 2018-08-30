<?php

use Faker\Generator as Faker;

$factory->define(App\Models\JobPost::class, function (Faker $faker) {
        $companyId= $faker->randomElement(\App\Models\Company::all()->pluck('id')->toArray());
        $company= App\Models\Company::find($companyId);
        $users= $faker->randomElement( $company->Users()->get()->pluck('id')->toArray());
    return [
        'company_id'=>$company,
        'user_id'=> $users ,
        'title'=>$faker->jobTitle,
        'summary'=>$faker->paragraph,
        'description'=>$faker->paragraph,
        'requirements'=>$faker->paragraph,
        'benefits'=>$faker->paragraph,
        'approval'=>$faker->boolean,
        'location'=>$faker->city,
        'publish_date'=>$faker->dateTimeBetween($startDate = 'now',$endDate ='+ 14 days'),
        'expiration_date'=>$faker->dateTimeBetween($startDate = 'now + 14 days',$endDate ='+ 28 days') ,
        'is_active'=>$faker->boolean

    ];

});
