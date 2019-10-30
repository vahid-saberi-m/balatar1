<?php

namespace App\Http\Controllers;

use App\Http\Requests\CandidateRequest;
use App\Models\Candidate\Candidate;
use App\Models\JobPost\JobPost;
use App\Repositories\CandidateRepository;
use Illuminate\Http\Request;

/**
 * @property CandidateRepository CandidateRepository
 */
class CandidateController extends Controller
{
    public function __construct(CandidateRepository $candidateRepository)
    {
        $this->CandidateRepository=$candidateRepository;
//        $this->middleware('auth:api')->only(['store', 'update','destroy','indexUser','store','approval','activate','update','delete']);
    }
    public function candidateExist(Request $request, JobPost $jobPost)
    {
        return $this->CandidateRepository->candidateExist($request,$jobPost);
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
    public function store(CandidateRequest $request)
    {
        $request->validated();
        return $this->CandidateRepository->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Candidate $candidate
     * @return \Illuminate\Http\Response
     */
    public function show(Candidate $candidate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Candidate $candidate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidate $candidate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Candidate $candidate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidate $candidate)
    {
        //
    }
}
