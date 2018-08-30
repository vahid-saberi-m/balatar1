<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Candidate::class, function (Faker $faker) {
    return [
        'phone'=>'22400853',
        'email'=>$faker->safeEmail,
        'name'=>$faker->name,
        'company'=>$faker->company,
        'position'=>$faker->jobTitle,
        'experience'=>$faker->numberBetween(1,10),
        'education'=>'جامعه شناسی',
        'degree'=>'کارشناسی ارشد',
        'university'=>'دانشگاه تهران'
    ];
});
