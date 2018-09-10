<?php

namespace App\Repositories;

use App\Models\Candidate;
use App\Models\JobPost;
use Illuminate\Http\Request;

class candidateRepository
{
    public function CandidateExist(Request $request, JobPost $jobPost = null)
    {
        $email = $request->input('email');
        /** @var Candidate $candidate */
        $candidate = Candidate::query()->where('email', $email)->first();
        if ($candidate && $jobPost) {
            if ($candidate->applications()->where('job_post_id', $jobPost->id)->exists()) {
                return 'شما پیش از این برای این شغل اقدام کرده اید';
            }
        }

        return $candidate;
    }

    public function store(Request $request)
    {
        $candidate = Candidate::query()->create([
            'phone' => $request->phone,
            'email' => $request->email,
            'name' => $request->name,
            'company' => $request->company,
            'position' => $request->position,
            'experience' => $request->experience,
            'education' => $request->education,
            'degree' => $request->degree,
            'university' => $request->university
        ]);

        return $candidate;
    }
}