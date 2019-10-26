<?php

namespace App\Http\Resources\CvFolder;

use Illuminate\Http\Resources\Json\JsonResource;

class CvFolderEmailTemplateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ['email_template'=>$this->email_template];
    }
}
