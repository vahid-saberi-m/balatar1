<?php

namespace App\Http\Controllers;

use App\Http\Requests\CvFolderRequest;
use App\Http\Resources\ApplicationResource;
use App\Http\Resources\CvFolderResource;
use App\Models\CvFolder;
use App\Models\JobPost;
use App\Models\User;
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
        return ApplicationResource::collection($cvFolder->applications()->paginate('10'));
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
