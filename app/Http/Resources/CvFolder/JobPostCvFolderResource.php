<?php

namespace App\Http\Resources\CvFolder;

use App\Http\Resources\Application\CvFolderApplicationResource;
use App\Models\Application;
use Illuminate\Http\Resources\Json\JsonResource;

class JobPostCvFolderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $applications=Application::where('cv_folder_id',$this->id)->orderByDesc('id')->paginate(5);
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'applications'=>CvFolderApplicationResource::collection($applications),
            'total'=>$applications->total(),
            'next_page'=>$applications->withPath('/'.$this->id)->nextPageUrl(),
            'previous_page'=>$applications->previousPageUrl(),
            'url'=>$applications->url(1)

        ];
    }
}
