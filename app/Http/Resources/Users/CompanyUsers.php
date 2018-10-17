<?php

namespace App\Http\Resources;

use App\Repositories\FileRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyUsers extends JsonResource
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
            'company_id'=>$this->company_id,
            'name'=>$this->name,
            'email'=>$this->email,
            'password'=>$this->password,
            'role'=>$this->role,
            'position'=>$this->position,
            'image'=>FileRepository::getUrl('/'.$this->image),
            'is_approved'=>$this->is_approved,
        ];
    }
}
