<?php

namespace App\Repositories;

use App\Models\Application;
use App\Models\Candidate;
use App\Models\CandidateCv;
use App\Models\CvFolder;
use App\Models\JobPost;
use Illuminate\Http\Request;

class ApplicationRepository
{
    public function store(JobPost $jobPost, Request $request)
    {
        $cvFolder = $jobPost->cvFolders()->where('name', 'در صف انتظار')->first();
        $candidate = Candidate::where('email' == $request->email)->first();

        if ($candidate) {
            $appliedBefore = $candidate->applications()->where('job_post_id', $jobPost->id)->exists();
            if ($appliedBefore) {
                return 'شما پیش از این یک بار برای کسب این شغل اقدام نموده اید.';
            }
            $sameInformation = ($candidate->email == $request->email) &&
                ($candidate->phone == $request->phone) &&
                ($candidate->email == $request->email) &&
                ($candidate->name == $request->name) &&
                ($candidate->company == $request->company) &&
                ($candidate->position == $request->position) &&
                ($candidate->experience == $request->experience) &&
                ($candidate->education == $request->education) &&
                ($candidate->degree == $request->degree) &&
                ($candidate->university == $request->university);
            if (!$sameInformation) {
                $candidate = app('App\Http\Controllers\CandidateController')->store($request);
            }
        } else {
            $candidate = app('App\Http\Controllers\CandidateController')->store($request);

        }
        $cv = CandidateCv::create([
            'candidate_id' => $candidate->id,
            'cv' => $request->file('cv')->store('/candidate/cvs')
        ]);
        Application::create([
            'candidate_id' => $candidate->id,
            'job_post_id' => $jobPost->id,
            'is_seen' => '0',
            'cv_id' => $cv->id,
            'cv_folder_id' => $cvFolder->id
        ]);
        return 'درخواست شما با موفقیت ثبت شد.';

    }

}
