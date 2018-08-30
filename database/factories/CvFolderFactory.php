<?php

use App\Models\CvFolder;
use App\Models\JobPost;
use Faker\Generator as Faker;

$factory->define(CvFolder::class, function (Faker $faker) {
    $RandomJobPost= $faker->randomElement(JobPost::all()->pluck('id')->toArray());
    $jobPost= JobPost::find($RandomJobPost);
        $company=$jobPost->company;
        $user= $jobPost->user;
        return [
            'name' => $faker->randomElement(['صف انتظار', 'رد شده', 'قابل تامل', 'مردود']),
            'company_id' =>$company->id,
            'user_id' => $user->id,
            'job_post_id' => $jobPost->id,

        ];
});

$factory->state(CvFolder::class, 'declined', [
    'name' => 'رد شده'
]);
$factory->state(CvFolder::class, 'waiting-queue', [
    'name' => 'صف انتظار'
]);
$factory->state(CvFolder::class, 'to-be-considered', [
    'name' => 'قابل تامل'
]);
$factory->state(CvFolder::class, 'inviting-to-interview', [
    'name' => 'دعوت به مصاحبه'
]);
