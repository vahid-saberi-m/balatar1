<?php

namespace App\Http\Controllers;

use App\Http\Requests\CvFolder\CvFolderChangeEmailTemplateRequest;
use App\Http\Requests\CvFolderRequest;
use App\Http\Resources\Application\CvFolderApplicationResource;
use App\Http\Resources\ApplicationResource;
use App\Http\Resources\CvFolder\CvFolderEmailTemplateResource;
use App\Http\Resources\CvFolderResource;
use App\Models\Application\CvFolder;
use App\Models\JobPost\JobPost;
use App\Models\User\User;
use App\Repositories\CvFolderRepository;
use Illuminate\Http\Request;
use App\Tools\ApiTrait;


/**
 * @property CvFolderRepository CvFolderRepository
 */
class CvFolderController extends Controller
{
    use ApiTrait;

    private $jobPostRepository;

    public function __construct(CvFolderRepository $cvFolderRepository)
    {
        $this->CvFolderRepository = $cvFolderRepository;
        $this->middleware('auth:api');
    }

    public function jobPostCvFolders(JobPost $jobPost)
    {
        $this->authorizeApi('isCompanyJobPost', array(JobPost::class, $jobPost));
        return CvFolderResource::collection($jobPost->cvFolders);
    }

    public function cvFolderApplications(CvFolder $cvFolder)
    {
        $jobPost = $cvFolder->jobPost;
        $this->authorizeApi('isCompanyJobPost', array(JobPost::class, $jobPost));
        return CvFolderApplicationResource::collection($cvFolder->applications()->orderByDesc('id')->paginate(5));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CvFolderRequest $request, JobPost $jobPost)
    {
        $this->authorizeApi('isCompanyJobPost', $jobPost);
        return $this->CvFolderRepository->store($request, $jobPost);
    }

    public function updateEmailTemplate(CvFolderChangeEmailTemplateRequest $request, CvFolder $cvFolder)
    {
        $this->authorizeApi('isCompanyJobPost', $cvFolder->jobPost);
        return $this->CvFolderRepository->updateEmailTemplate($request, $cvFolder);
    }
    public function showEmailTemplate( CvFolder $cvFolder)
    {
        $this->authorizeApi('isCompanyJobPost', $cvFolder->jobPost);
        return new CvFolderEmailTemplateResource( $cvFolder);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CvFolder $cvFolder
     * @return \Illuminate\Http\Response
     */
    public function show(CvFolder $cvFolder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\CvFolder $cvFolder
     * @return \Illuminate\Http\Response
     */
    public function update(CvFolderRequest $request, CvFolder $cvFolder)
    {
        $this->authorizeApi('isCompanyJobPost', $cvFolder->jobPost);
        $cvFolder->update(['name' => $request->name]);
        return new CvFolderResource($cvFolder);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CvFolder $cvFolder
     * @return string
     * @throws \Exception
     */
    public function destroy(CvFolder $cvFolder)
    {
        $this->authorizeApi('isCompanyJobPost', $cvFolder->jobPost);
        $cvFolder->applications()->delete();
        $cvFolder->delete($cvFolder);
        return 'deleted';
    }

    public function createJobPostCvFolders(JobPost $jobPost)
    {
        return $this->CvFolderRepository->CreateJobPostCvFolders($jobPost);
    }
}
