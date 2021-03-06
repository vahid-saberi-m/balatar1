<?php

namespace App\Http\Resources;

use App\Repositories\FileRepository;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class Company extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'id'=>$this-> id ,
            'name'=> $this-> name,
            'company_size'=>$this->company_size,
            'slogan'=>$this->slogan,
            'website'=>$this->website,
            'logo'=>FileRepository::getUrl($this->logo),
            'message_title'=>$this->message_title,
            'message_content'=>$this->message_content,
            'main_photo'=>FileRepository::getUrl($this->main_photo),
            'about_us'=>$this->about_us,
            'why_us'=>$this->why_us,
            'recruiting_steps'=>$this->recruiting_steps,
            'address'=>$this->address,
            'email'=>$this->email,
            'phone_number'=>$this->phone_number,
            'location'=>$this->location,
        ];
    }
}
