<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobPostRequest;
use App\Http\Resources\JobPostResource;
use App\Models\JobPost;
use App\Models\Company;
use App\Tools\ApiTrait;
use Illuminate\Http\Request;
use App\Repositories\JobPostRepository;
use App\Repositories\CvFolderRepository;
use phpDocumentor\Reflection\Types\Array_;


class JobPostController extends Controller
{
    use ApiTrait;

    private $jobPostRepository;

    public function __construct(JobPostRepository $jobPostRepository)
    {
        $this->jobPostRepository = $jobPostRepository;
        $this->middleware('auth:api')->except(['show','indexPublic']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPublic(Company $company)
    {
        return $this->jobPostRepository->indexPubic($company);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUser(Company $company)
    {
        $this->authorizeApi('indexUser', JobPost::class, $company);
        return $this->jobPostRepository->indexUser($company);
    }

    public function lastFive(){

        return $this->jobPostRepository->lastFive();

    }
    public function indexWaiting()
    {
        return $this->jobPostRepository->indexWaiting();
    }

    public function indexLive()
    {
        return $this->jobPostRepository->indexLive();
    }

    public function indexExpired()
    {
        return $this->jobPostRepository->indexExpired();
    }


    public function jobPostApplications(JobPost $jobPost)
    {
        $this->authorizeApi('isCompanyJobPost', $jobPost);
        return $this->jobPostRepository->jobPostApplications($jobPost);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobPostRequest $request)
    {
        return $this->jobPostRepository->store($request);
    }

    public function approval(JobPost $jobPost)
    {
        $this->authorizeApi('approval', $jobPost);
        return $this->jobPostRepository->approval($jobPost);

    }

    public function activate(JobPost $jobPost)
    {

        $this->authorizeApi('activate', $jobPost);
        return $this->jobPostRepository->activate($jobPost);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobPost $jobPost
     * @return \Illuminate\Http\Response
     */
    public function show(JobPost $jobPost)
    {
        if ($jobPost->is_active==1) {
            return new JobPostResource($jobPost);
        } else{
            return 'not active';
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\JobPost $jobPost
     * @return \Illuminate\Http\Response
     */
    public function update(JobPostRequest $request, JobPost $jobPost)
    {
        $this->authorizeApi('update', $jobPost);

        return $this->jobPostRepository->update($request->all(), $jobPost);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobPost $jobPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobPost $jobPost)
    {
        $this->authorizeApi('delete', $jobPost);
        return $this->jobPostRepository->delete($jobPost);

    }
}
