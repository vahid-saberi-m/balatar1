<?php

namespace App\Http\Controllers;

use App\Models\CvFolder;
use App\Models\JobPost;
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
        $this->CvFolderRepository=$cvFolderRepository;
        $this->middleware('auth:api');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CvFolder  $cvFolder
     * @return \Illuminate\Http\Response
     */
    public function show(CvFolder $cvFolder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CvFolder  $cvFolder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CvFolder $cvFolder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CvFolder  $cvFolder
     * @return \Illuminate\Http\Response
     */
    public function destroy(CvFolder $cvFolder)
    {
        //
    }

    public function createJobPostCvFolders(JobPost $jobPost)
    {
       return $this->CvFolderRepository->CreateJobPostCvFolders($jobPost);
    }
}
