<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\QuestionCollection;
use App\Models\JobPost;
use App\Models\Question;
use App\Tools\ApiTrait;
use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;

class questionController extends Controller
{
    use ApiTrait;
    private $questionRepository;
    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository=$questionRepository;
    }

    public function jobPostQuestions(JobPost $jobPost)
   {
       return  QuestionResource::collection($jobPost->questions);
   }

   public function answerCheck(JobPost $jobPost,Request $request)
   {
    return  $this->questionRepository->answerCheck($request, $jobPost);
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
    public function store(QuestionRequest $request,JobPost $jobPost)
    {
        $this->authorizeApi('isCompanyJobPost',$jobPost);
        return $this->questionRepository->store($request,$jobPost);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return new QuestionResource($question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}
