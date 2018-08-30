<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Event::class, function (Faker $faker) {
    return [
        'company_id'=>$faker->randomElement(\App\Models\Company::all()->pluck('id')->toArray()),
        'title'=>$faker->streetName,
        'content'=>$faker->paragraph ,
        'main_photo'=> '/images/events/avatar',
        'tags'=>null,
    ];
});
