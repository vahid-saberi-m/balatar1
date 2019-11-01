<?php

namespace App\Http\Resources\Application;

use App\Http\Resources\JobPost\JobPostRatingFieldsResource;
use App\Models\Candidate\CandidateCv;
use App\Repositories\FileRepository;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ApplicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'is_seen' => $this->is_seen,
            'name' => $this->name,
            'position' => $this->position,
            'company' => $this->company,
            'education' => $this->education,
            'degree' => $this->degree,
            'phone' => $this->phone,
            'university' => $this->university,
            'cv_folder_id' => $this->cv_folder_id,
            'cv' => route('applications.cvShow', ['candidateCv' => $this->candidate_cv]),
            'comments'=>   ApplicationCommentsResource::collection($this->applicationComments()->get()),
            'ratingFields'=>   ApplicationRatingsResource::collection($this->applicationRatings()->get()),
            'jobPostRatingFields' =>   JobPostRatingFieldsResource::collection($this->jobPost->jobPostRatingFields),

        ];
    }
}
