<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationRequest;
use App\Models\Application;
use App\Models\Candidate;
use App\Models\CandidateCv;
use App\Models\CvFolder;
use App\Models\JobPost;
use App\Models\User;
use App\Repositories\ApplicationRepository;
use Illuminate\Http\Request;
use App\Tools\ApiTrait;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    use ApiTrait;
    private $applicationRepository;
    public function __construct(ApplicationRepository $applicationRepository)
    {
        $this->applicationRepository = $applicationRepository;
        $this->middleware('auth:api')->except(['store','returnCv']);
    }
    public function appliedBefore(JobPost $jobPost, Request $request)
    {
        return $this->applicationRepository->appliedBefore($jobPost,$request);
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

    public function changeCvFolder( Application $application, CvFolder $cvFolder){
        $this->authorizeApi('show',$application);
        return $this->applicationRepository->changeCvFolder($application,$cvFolder);

    }
    public function returnCv(CandidateCv $candidateCv)
    {
        return
            Storage::get($candidateCv->cv);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApplicationRequest $request, JobPost $jobPost)
    {
        return $this->applicationRepository->store($jobPost, $request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Application $application
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application)
    {
        $this->authorizeApi('show',$application);
       return $this->applicationRepository->show($application);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Application $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Application $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        $this->authorizeApi('show',$application);
        $application->delete();
        return 'deleted';
    }
}
