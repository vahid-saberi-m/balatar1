<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Application::class, function (Faker $faker) {
    $jobPostId = $faker->randomElement(\App\Models\JobPost::all()->pluck('id')->toArray());
    $jobPost = App\Models\JobPost::find($jobPostId);
    $CvFolderId = $faker->randomElement($jobPost->CvFolders()->pluck('id')->toArray());
    $CvFolder = App\Models\CvFolder::find($CvFolderId);
    return [
        'candidate_id' => $faker->randomElement(\App\Models\Candidate::all()->pluck('id')->toArray()),
        'job_post_id' => $jobPostId,
        'is_seen' => $faker->boolean,
        'candidate_cv' => '1',
        'cv_folder_id' => $CvFolder,
        'phone'=>'22400853',
        'name' => $faker->name,
        'company' => $faker->company,
        'position' => $faker->jobTitle,
        'experience' => $faker->numberBetween(1, 10),
        'education' => 'جامعه شناسی',
        'degree' => 'کارشناسی ارشد',
        'university' => 'دانشگاه تهران'

    ];
});
