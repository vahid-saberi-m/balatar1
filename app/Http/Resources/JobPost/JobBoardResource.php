<?php

namespace App\Http\Resources\JobPost;

use App\Http\Resources\CvFolder\JobPostCvFolderResource;
use App\Models\Application\CvFolder;
use App\Models\JobPost\JobPost;
use Illuminate\Http\Resources\Json\JsonResource;

class JobBoardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $cvFolders=CvFolder::where('job_post_id',$this->id)->get();
        return[
            'email_template'=> $cvFolders->first()->jobPost->email_template,
            'cv_folders'=>  JobPostCvFolderResource::collection($cvFolders)
        ];
    }
}
