<?php

namespace App\Repositories;

use App\Http\Resources\Candidate\CandidateAppliedBeforeResource;
use App\Http\Resources\Candidate\CandidateDidNotApplyBeforeResource;
use App\Http\Resources\Candidate\CandidateDoesNotExist;
use App\Http\Resources\Candidate\CandidateResource;
use App\Models\CandidateCandidate;
use App\Models\JobPost\JobPost;
use Illuminate\Http\Request;

class CandidateRepository
{
    public function CandidateExist(Request $request, JobPost $jobPost)
    {
        /** @var Candidate $candidate */
        $candidate = Candidate::query()->where('email', 'LIKE', $request->email)->first();
        if ($candidate) {
            $appliedBefore=$candidate->applications()->where('job_post_id',$jobPost->id)->exists();
            if ($appliedBefore) {
                return new CandidateAppliedBeforeResource($candidate);
            } else {
                return new CandidateDidNotApplyBeforeResource($candidate);
            }
        }
        return new CandidateDoesNotExist($request);

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