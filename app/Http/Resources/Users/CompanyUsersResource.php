<?php

namespace App\Http\Resources\Users;

use App\Repositories\FileRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyUsersResource extends JsonResource
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
            'company_id'=>$this->company_id,
            'name'=>$this->name,
            'email'=>$this->email,
            'role'=>$this->role,
            'position'=>$this->position,
            'image'=>FileRepository::getUrl($this->image),
            'is_approved'=>$this->is_approved,
        ];
    }
}
