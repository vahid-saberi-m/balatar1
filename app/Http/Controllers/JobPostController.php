<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobPost\AddEmailTemplateRequest;
use App\Http\Requests\JobPostRequest;
use App\Http\Resources\JobPost\JobBoardResource;
use App\Http\Resources\JobPost\JobPostRatingFieldsResource;
use App\Http\Resources\JobPostResource;
use App\Models\JobPost\JobPost;
use App\Models\Company\Company;
use App\Models\JobPost\JobPostRatingField;
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
        $this->middleware('auth:api')->except(['show', 'indexPublic']);
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

    public function addEmailTemplate(JobPost $jobPost, Request $request)
    {
        $this->authorizeApi('isCompanyJobPost', $jobPost);

        return $this->jobPostRepository->addEmailTemplate($request, $jobPost);
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

    public function lastFive()
    {

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
        if ($jobPost->is_active == 1) {
            return new JobPostResource($jobPost);
        } else {
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

    public function jobBoard(JobPost $jobPost)
    {
        $this->authorizeApi('isCompanyJobPost', array(JobPost::class, $jobPost));
        return new JobBoardResource($jobPost);
    }

    public function jobPostRatingFields(JobPost $jobPost)
    {
        $this->authorizeApi('isCompanyJobPost', array(JobPost::class, $jobPost));
        return JobPostRatingFieldsResource::collection($jobPost->jobPostRatingFields()->get());
    }

    public function addJobPostRatingFields(JobPost $jobPost, Request $request)
    {

        $this->authorizeApi('isCompanyJobPost', array(JobPost::class, $jobPost));
        return $this->jobPostRepository->addJobPostRatingFields($jobPost, $request);
    }

    public function deleteJobPostRatingFields(JobPostRatingField $jobPostRatingField)
    {
        $this->authorizeApi('isCompanyJobPost', array(JobPost::class, $jobPostRatingField->jobPost));
        $jobPostRatingField->delete();
        return JobPostRatingFieldsResource::collection($jobPostRatingField->jobPost->jobPostRatingFields);
    }
}
