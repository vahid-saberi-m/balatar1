<?php
/**
 * Created by PhpStorm.
 * User: vahid
 * Date: 8/28/2018
 * Time: 2:04 PM
 */

namespace App\Repositories;

use App\Models\JobPost;

class JobPostRepository
{
    public function show(JobPost $jobPost)
    {
//        $jobPost->load(['jobPosts' => function($query) { $query->where('is_active', 1)->orderByDesc('id')->take(10);}]);

        return $jobPost;
    }
}