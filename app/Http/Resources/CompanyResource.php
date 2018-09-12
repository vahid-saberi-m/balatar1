<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'name'=>$this->name,
            'company_size'=>$this->company_size,
            'slogan'=>$this->slogan,
            'website'=>$this->website,
            'logo'=>$this->logo,
            'message_title'=>$this->message_title,
            'message_content'=>$this->message_content,
            'main_photo'=>$this->main_photo,
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
