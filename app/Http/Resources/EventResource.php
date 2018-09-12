<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class EventResource extends JsonResource
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
            'title'=>$this->title,
            'content'=>$this->content,
            'main_photo'=>Storage::url($this->main_photo),
            'tags'=>$this->tags,
            'id'=>$this->id
        ];
    }
}
