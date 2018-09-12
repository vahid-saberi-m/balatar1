<?php

namespace App\Repositories;

use App\Http\Resources\CandidateResource;
use App\Models\Candidate;
use App\Models\JobPost;
use Illuminate\Http\Request;

class CandidateRepository
{
    public function CandidateExist(Request $request, JobPost $jobPost)
    {
        /** @var Candidate $candidate */
        $candidate = Candidate::query()->where('email', 'LIKE', $request->email)->first();
        if ($candidate) {
            $appliedBefore=$candidate->applications->where('job_post_id',$jobPost->id)->count();
            if ($appliedBefore) {
                return 'شما پیش از این برای این شغل اقدام کرده اید';
            } else {
                return new CandidateResource($candidate);
            }
        }
        return 0;

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

    public function update(Candidate $candidate, Request $request)
    {
        $candidate->update([$request->all()]);
        return $candidate;
    }
}