<?php

namespace App\Http\Resources;

use App\Repositories\FileRepository;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CandidateCvResource extends JsonResource
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
            'cv'=>FileRepository::getUrl($this->cv),
            'file_name'=>$this->file_name
        ];
    }
}
