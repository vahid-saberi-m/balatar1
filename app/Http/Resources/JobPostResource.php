<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobPostResource extends JsonResource
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
            'title'=>$this->title,
            'summary'=>$this->summary,
            'description'=>$this->description,
            'requirements'=>$this->requirements,
            'benefits'=>$this->benefits,
            'location'=>$this->location,
            'publish_date'=>$this->publish_date,
        ];
    }
}
