<?php

namespace App\Http\Resources;

use App\Models\CandidateCv;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'is_seen'=>$this->is_seen,
            'name'=>$this->name,
            'position'=>$this->position,
            'company'=>$this->company,
            'cv_folder_id'=>$this->cv_folder_id,
            'cv'=>CandidateCv::query()->find($this->candidate_cv)
        ];
    }
}
