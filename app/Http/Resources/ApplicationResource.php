<?php

namespace App\Http\Resources;

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
        ];
    }
}
