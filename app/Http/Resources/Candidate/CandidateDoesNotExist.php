<?php

namespace App\Http\Resources\Candidate;

use Illuminate\Http\Resources\Json\JsonResource;

class CandidateDoesNotExist extends JsonResource
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
            'candidate'=>false,
            'applied_before'=>false,
        ];
    }
}
