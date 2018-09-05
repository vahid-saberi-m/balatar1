<?php
/**
 * Created by PhpStorm.
 * User: vahid
 * Date: 8/28/2018
 * Time: 2:04 PM
 */

namespace App\Repositories;

use App\Models\Company;
use App\Models\JobPost;
use App\Models\User;

class JobPostRepository
{
    public function show(JobPost $jobPost)
    {
//        $jobPost->load(['jobPosts' => function($query) { $query->where('is_active', 1)->orderByDesc('id')->take(10);}]);

        return $jobPost;
    }

    /**
     * @param $company
     */
    public function indexPubic(Company $company)
    {
        $jobPosts = $company->jobPosts->where('is_active', '1')->where('approval', '1');
        return $jobPosts;
    }

    public function indexUser(Company $company)
    {
        $user=auth()->user();
        if ($user->role == 'admin') {
            $jobPosts = $company->jobPosts;
            return $jobPosts;
        } else {
            $jobPosts = $user->jobPosts;
            return $jobPosts;
        }
    }
}