<?php

namespace App\Repositories;

use App\Models\JobPost\JobPost;
use App\Models\JobPost\Question;
use Illuminate\Http\Request;

class QuestionRepository
{
    public function answerCheck(Request $request, JobPost $jobPost)
    {
        $questions = $jobPost->questions;

        foreach ($questions as $question) {
            $value = $request->input($question->id);
            if ($question->$value == 0) {
                return 0;
            }
            return 1;
        }

    }

    public function store(Request $request, JobPost $jobPost)
    {
        $limit = $jobPost->company->package->question_per_job_post_limit;
        $questionCount = $jobPost->questions()->count();
        if ($questionCount > $limit) {
            return 'محدودیت بسته شما اجازه طرح سوالات بیشتر برای این آگهی را نمی دهد.';
        } else {
            $question = Question::query()->create(array_merge([
                'company_id' => $jobPost->company_id,
                'job_post_id' => $jobPost->id], $request->toArray()
            ));
        return $question;
        }
    }
}