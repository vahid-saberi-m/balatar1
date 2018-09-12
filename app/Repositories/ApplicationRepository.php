<?php

namespace App\Repositories;

use App\Models\Application;
use App\Models\Candidate;
use App\Models\CandidateCv;
use App\Models\CvFolder;
use App\Models\JobPost;
use Illuminate\Http\Request;
use App\Http\Resources\ApplicationResource;

class ApplicationRepository
{
    private $candidateRepository;

    public function __construct(CandidateRepository $candidateRepository)
    {
        $this->candidateRepository = $candidateRepository;
    }

    public function store(JobPost $jobPost, Request $request)
    {
        $cvFolder = $jobPost->cvFolders()->where('name', 'صف انتظار')->first();
        $candidate = Candidate::where('email', 'LIKE', $request->email)->first();

        if ($candidate) {
            $appliedBefore = $candidate->applications->where('job_post_id', $jobPost->id);
            if ($appliedBefore) {
                return 'شما پیش از این یک بار برای کسب این شغل اقدام نموده اید.';
            } else {
                $candidate = $this->candidateRepository->update($candidate, $request);
            }
        } else {
            $candidate = $this->candidateRepository->store($request);
        }

        if ($request->file('cv')) {
            $cv = CandidateCv::create([
                'candidate_id' => $candidate->id,
                'cv' => $request->file('cv')->store('/candidate/cvs'),
                'file_name' => $request->file('cv')->getClientOriginalName()
            ]);

        } else {
            $cv = $candidate->candidateCvs->find($request->cv_id)->get();
        }

//        dd($cv->id);
        $app = Application::query()->create(array_merge([
            'candidate_id' => $candidate->id,
            'job_post_id' => $jobPost->id,
            'is_seen' => '0',
            'candidate_cv' => $cv->id,
            'cv_folder_id' => $cvFolder->id,],
            $request->all()
        ));
        return $app; //'درخواست شما با موفقیت ثبت شد.';
    }

    public function show(Application $application)
    {
        $packageUsage = $application->jobPost->company->packageUsage;
        $daily = $packageUsage->daily_cv_view_left - 1;
        $monthly = $packageUsage->monthly_cv_view_left - 1;
        if ($daily > 0 && $monthly > 0) {
            $application->update(['is_seen' => 1]);
            $packageUsage->update(['daily_cv_view_left'=>$daily,'monthly_cv_view_left'=>$monthly]);
            return new ApplicationResource($application);
        } else {
            return $packageUsage;
        }
    }

}
