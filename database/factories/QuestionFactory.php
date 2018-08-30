<?php

use Faker\Generator as Faker;


$factory->define(\App\Models\Question::class, function (Faker $faker) {
    $jobPostId= $faker->randomElement(\App\Models\JobPost::all()->pluck('id')->toArray());
    $jobPost= \App\Models\JobPost::find($jobPostId);
    return [
        'company_id'=>$jobPost->company_id,
        'job_post_id'=>$jobPost->id,
        'question'=>$faker->realText($maxNbChars = 200, $indexSize = 2),
        'answer_1'=>$faker->realText($maxNbChars = 60, $indexSize = 2),
        'value_1'=>$faker->boolean(),
        'answer_2'=>$faker->realText($maxNbChars = 60, $indexSize = 2),
        'value_2'=>$faker->boolean(),
        'answer_3'=>$faker->realText($maxNbChars = 60, $indexSize = 2),
        'value_3'=>$faker->boolean(),
        'answer_4'=>$faker->realText($maxNbChars = 60, $indexSize = 2),
        'value_4'=>$faker->boolean(),
    ];
});
