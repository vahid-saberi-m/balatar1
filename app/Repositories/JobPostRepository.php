<?php
/**
 * Created by PhpStorm.
 * User: vahid
 * Date: 8/28/2018
 * Time: 2:04 PM
 */

namespace App\Repositories;

use App\Http\Requests\JobPostRequest;
use App\Models\Company;
use App\Models\JobPost;
use App\Models\User;
use App\Repositories\CvFolderRepository;
use Carbon\Carbon;
use function Couchbase\defaultDecoder;
use http\Env\Request;
use phpDocumentor\Reflection\Types\Array_;

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
        $user = auth()->user();
        if ($user->role == 'admin') {
            $jobPosts = $company->jobPosts;
            return $jobPosts;
        } else {
            $jobPosts = $user->jobPosts;
            return $jobPosts;
        }
    }

    public function store(JobPostRequest $request)
    {
//        dd($request->title);
        //Cheks how many cv views can this company have and how long can a job post be live
        $cvView = auth()->user()->company->package->per_job_post_cv_view;
        ($cvView == null) ? $cvView = 10000 : $cvView;
        // adds maximum job post life time days to publish date if its still before declared expiration dates it will automatically change it to the limit day
        $jobPostLifetimeLimit = auth()->user()->company->package->job_post_lifetime_limit;
        $publishDate=new Carbon($request->publish_date);
        $expirationDate=new Carbon($request->expiration_date);
        $limitDay=  $publishDate->addDays($jobPostLifetimeLimit);
        (!$expirationDate->gt($limitDay))?:$expirationDate=$limitDay;
        $jobPost = JobPost::create([
            'company_id' => auth()->user()->company_id,
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'summary' => $request->summary,
            'description' => $request->description,
            'requirements' => $request->requirements,
            'benefits' => $request->benefits,
            'approval' => (auth()->user()->role == 'admin') ? 1 : 0,
            'location' => $request->location,
            'publish_date' => $request->publish_date,
            'expiration_date' => $expirationDate->toDateString(),
            'cv_views' => $cvView,
            'is_active' => 0
        ]);
        return $jobPost;
    }

    public function approval(JobPost $jobPost)
    {
        $jobPost->update(array('approval'=> ($jobPost->approval == 0) ? 1 : 0));

        return $jobPost ;
    }

    public function activate(JobPost $jobPost)
    {
     //activates jobPost and builds 4 basic CvFolders for it
        $jobPost->update(array('is_active'=> ($jobPost->is_active == 0) ? 1 : 0));
        return app('App\Http\Controllers\CvFolderController')->createJobPostCvFolders($jobPost);
    }
    public function update(JobPostRequest $request,JobPost $jobPost){
        // adds maximum job post life time days to publish date if its still before declared expiration dates it will automatically change it to the limit day
        $jobPostLifetimeLimit = auth()->user()->company->package->job_post_lifetime_limit;
        $publishDate=new Carbon($request->publish_date);
        $expirationDate=new Carbon($request->expiration_date);
        $limitDay=  $publishDate->addDays($jobPostLifetimeLimit);
        (!$expirationDate->gt($limitDay))?:$expirationDate=$limitDay;
        $jobPost ->update([
            'title' => $request->title,
            'summary' => $request->summary,
            'description' => $request->description,
            'requirements' => $request->requirements,
            'benefits' => $request->benefits,
            'location' => $request->location,
            'publish_date' => $request->publish_date,
            'expiration_date' => $expirationDate->toDateString(),
        ]);
        return $jobPost;
    }
}