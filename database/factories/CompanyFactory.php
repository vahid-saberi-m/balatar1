<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Company::class, function (Faker $faker) {
        return [
        'name'=>$faker->company,
        'company_size'=>$faker->randomElement(['10','50','100','200']),
        'slogan'=>'باما کار کنید',
        'website'=>$faker->domainName,
        'logo'=>'/images/companies/avatar',
        'message_title'=>'ما در اینجا.....',
        'message_content'=>$faker->paragraph('10'),
        'main_photo'=>'/images/companies/mainphotos/avatar',
        'about_us'=>$faker->paragraph('10'),
        'why_us'=>$faker->paragraph('10'),
        'recruiting_steps'=>$faker->paragraph('10'),
        'address'=>$faker->address,
        'email'=>$faker->safeEmail,
        'phone_number'=>$faker->numberBetween(10,100),
        'location'=>$faker->city,
            'package_id'=>$faker->randomElement(\App\Models\Package::all()->pluck('id')->toArray()),
            'is_live'=>$faker->randomElement(['0','1'])
    ];
});
