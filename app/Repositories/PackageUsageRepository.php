<?php

namespace App\Repositories;


use App\Http\Requests\JobPostRequest;
use App\Models\Company\Company;
use App\Models\JobPost\JobPost;
use Carbon\Carbon;

class PackageUsageRepository
{

    public function remainingJobPosts(Company $company, $value)
    {
        $packageUsage = $company->packageUsage;
        $remainingJobPosts = $packageUsage->active_job_post_left;
        if ($value == 1) {
            $remainingJobPosts = $remainingJobPosts - 1;
            if($remainingJobPosts >= 0) {
                $packageUsage->query()->update(['active_job_post_left'=> $remainingJobPosts]);
                return true;
            } else{
                return null;
            }
        }
        else  {
            $remainingJobPosts = $remainingJobPosts + 1;
            $packageUsage->update(array('active_job_post_left'=> $remainingJobPosts));
            return true;
        }
    }
}