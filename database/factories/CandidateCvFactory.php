<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\CandidateCv::class, function (Faker $faker) {
    return [
        'candidate_id'=> $faker->randomElement(App\Models\Candidate::all()->pluck('id')->ToArray()),
        'cv'=> '/public/candidate/cv/avatar.pdf',
        'file_name'=>'some file.pdf'
    ];
});
