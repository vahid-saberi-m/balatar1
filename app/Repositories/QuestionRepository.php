<?php

namespace App\Repositories;

use App\Models\JobPost;
use App\Models\Question;
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
}