<?php
/**
 * Created by PhpStorm.
 * User: vahid
 * Date: 8/28/2018
 * Time: 2:04 PM
 */

namespace App\Repositories;

use App\Http\Requests\JobPostRequest;
use App\Http\Resources\ApplicationCollection;
use App\Http\Resources\JobPost\JobPostTitleCollection;
use App\Http\Resources\JobPostCollection;
use App\Http\Resources\JobPostResource;
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
    private $packageUsageRepository;
    private $cvFolderRepository;

    public function __construct(PackageUsageRepository $packageUsageRepository, CvFolderRepository $cvFolderRepository)
    {
        $this->packageUsageRepository = $packageUsageRepository;
        $this->cvFolderRepository = $cvFolderRepository;
    }


    public function jobPostApplications(JobPost $jobPost){
        $applications=$jobPost->applications;
        if($applications){
        return new ApplicationCollection($applications);
        }else{
            return 'no application';
        }
    }
    /**
     * @param $company
     */
    public function indexPubic(Company $company)
    {
        $jobPosts = $company->jobPosts->where('is_active', '1')->where('approval', '1');
        return new JobPostCollection($jobPosts);
    }

    public function indexUser(Company $company)
    {
        $user = auth()->user();
        if ($user->role == 'admin') {
            $jobPosts = $company->jobPosts;
            return new JobPostCollection($jobPosts);
        } else {
            $jobPosts = $user->jobPosts;
            return new JobPostCollection($jobPosts);
        }
    }
    public function indexWaiting()
    {
        $user = auth()->user();
        if ($user->role == 'admin') {
            $jobPosts = $user->company->jobPosts()->where(['approval'=>0])->paginate(5);
            return new JobPostCollection($jobPosts);
        } else {
            $jobPosts = $user->jobPosts()->where(['approval'=>0])->paginate(5);
            return new JobPostCollection($jobPosts);
        }
    }

    public function indexLive()
    {
        $user = auth()->user();
        if ($user->role == 'admin') {
            $jobPosts = $user->company->jobPosts()->where(['approval'=>1,'is_active'=>1,['publish_date','<=',Carbon::now()],['expiration_date','>=',Carbon::now()]])->paginate(5);
            return new JobPostCollection($jobPosts);
        } else {
            $jobPosts = $user->jobPosts()->where(['approval'=>1,'is_active'=>1,['publish_date','<=',Carbon::now()],['expiration_date','>=',Carbon::now()]])->paginate(5);
            return new JobPostCollection($jobPosts);
        }
    }
    public function indexExpired()
    {
        $user = auth()->user();
        if ($user->role == 'admin') {
            $jobPosts = $user->company->jobPosts()->where(['approval'=>1,['expiration_date','<=',Carbon::now()]])->paginate(5);
            return new JobPostCollection($jobPosts);
        } else {
            $jobPosts = $user->jobPosts()->where(['approval'=>1,['expiration_date','<=',Carbon::now()]])->paginate(5);
            return new JobPostCollection($jobPosts);
        }
    }

    public function lastFive(){
        $jobPosts=auth()->user()->jobPosts()->orderBy('id','desc')->take(5)->get();
        return new JobPostTitleCollection($jobPosts);
    }

    public function store(JobPostRequest $request)
    {
        //Cheks how many cv views can this company have and how long can a job post be live
        $cvView = auth()->user()->company->package->per_job_post_cv_view;
        ($cvView == null) ? $cvView = 10000 : $cvView;
        // adds maximum job post life time days to publish date if its still before declared expiration dates it will automatically change it to the limit day
        $jobPostLifetimeLimit = auth()->user()->company->package->job_post_lifetime_limit;
        $publishDate = new Carbon($request->publish_date);
        $expirationDate = new Carbon($request->expiration_date);
        $limitDay = $publishDate->addDays($jobPostLifetimeLimit);
        (!$expirationDate->gt($limitDay)) ?: $expirationDate = $limitDay;
        $jobPost = JobPost::create(array_merge([
            'company_id' => auth()->user()->company_id,
            'user_id' => auth()->user()->id,
            'is_active' => 0,
            'approval' => (auth()->user()->role == 'admin') ? 1 : 0,
            'publish_date' => $request->publish_date,
            'expiration_date' => $expirationDate->toDateString(),
            'cv_views' => $cvView,
        ], $request->all()));
        $this->cvFolderRepository->CreateJobPostCvFolders($jobPost);
        return new JobPostResource($jobPost);
    }

    public function approval(JobPost $jobPost)
    {
        $jobPost->update(array('approval' => ($jobPost->approval == 0) ? 1 : 0));

        return $jobPost;
    }

    public function activate(JobPost $jobPost)
    {
        $company = $jobPost->company;
        if ($jobPost->is_active == 0) {
            $value = 1;
            $packageUsage = $this->packageUsageRepository->remainingJobPosts($company, $value);
            if ($packageUsage) {
                $jobPost->update(array('is_active' => 1));
                return 'فعال شد';
            } else {
                return 'شما حد اکثر فرصت های شغلی فعال بسته خود را مصرف نموده اید';
            }
        }
        if ($jobPost->is_active == 1) {
            $value = 0;
            $this->packageUsageRepository->remainingJobPosts($company, $value);
            $jobPost->update(array('is_active' => 0));
            return 'غیر فعال شد';
        }


    }

    public function update(array $data, JobPost $jobPost)
    {
        // adds maximum job post life time days to publish date if its still before declared expiration dates it will automatically change it to the limit day
        $jobPostLifetimeLimit = auth()->user()->company->package->job_post_lifetime_limit;
        $publishDate = new Carbon($data['publish_date']);
        $expirationDate = new Carbon($data['expiration_date']);
        $limitDay = $publishDate->addDays($jobPostLifetimeLimit);
        if ($expirationDate->gt($limitDay)) {
            $expirationDate = $limitDay;
        }
        $data['expiration_date'] = $expirationDate->toDateString();

        $jobPost->update($data);

        return $jobPost;
    }

    public function delete(JobPost $jobPost)
    {
        $jobPost->delete();
        return 'deleted';
    }
}