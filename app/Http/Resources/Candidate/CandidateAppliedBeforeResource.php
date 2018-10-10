<?php

namespace App\Http\Resources\Candidate;

use App\Http\Resources\CandidateCvResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CandidateAppliedBeforeResource extends JsonResource
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
            'candidate' => true,
            'applied_before' => true,
            'id' => $this->id,
            'phone' => $this->phone,
            'email' => $this->email,
            'name' => $this->name,
            'company' => $this->company,
            'position' => $this->position,
            'experience' => $this->experience,
            'education' => $this->education,
            'degree' => $this->degree,
            'university' => $this->university,
            'cvs' => CandidateCvResource::collection($this->candidateCvs)
        ];
    }
}
