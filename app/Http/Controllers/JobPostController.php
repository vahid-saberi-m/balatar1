<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobPostRequest;
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
        $this->jobPostRepository=$jobPostRepository;
        $this->middleware('auth:api')->only(['store', 'update','destroy','indexUser','store','approval','activate']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPublic(Company $company)
    {
       return response()->json($this->jobPostRepository->indexPubic($company));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUser(Company $company)
    {
        $this->authorizeApi('indexUser',JobPost::class,$company);
        return $this->jobPostRepository->indexUser($company);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( JobPostRequest $request)
    {
//        $this->authorizeApi('store',array(JobPost::class, $request, $user=auth()->user()));
        $validated=$request->validated();
        return $this->jobPostRepository->store($request);
    }

    public function approval(JobPost $jobPost){
        $this->authorizeApi('approval',$jobPost);
        return $this->jobPostRepository->approval($jobPost);

    }

    public function activate(JobPost $jobPost){

        $this->authorizeApi('activate',$jobPost);
        return $this->jobPostRepository->activate($jobPost);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobPost  $jobPost
     * @return \Illuminate\Http\Response
     */
    public function show(JobPost $jobPost)
    {
        $this->authorize('view', $jobPost);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobPost  $jobPost
     * @return \Illuminate\Http\Response
     */
    public function update(JobPost $jobPost,JobPostRequest $request)
    {
        $this->authorizeApi('update',$jobPost);
        $request->validated();
        return $this->jobPostRepository->update($request,$jobPost);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobPost  $jobPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobPost $jobPost)
    {
        //
    }
}
