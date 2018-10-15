<?php

namespace App\Http\Resources;

use App\Repositories\FileRepository;
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
            'main_photo'=>FileRepository::getUrl($this->main_photo),
            'tags'=>$this->tags,
            'id'=>$this->id
        ];
    }
}
