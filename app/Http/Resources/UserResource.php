<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'image'=>$this->image,
            'is_approved'=>$this->is_approved,
            'company_is_live'=>auth()->user()->company->is_live,

        ];
    }
}
