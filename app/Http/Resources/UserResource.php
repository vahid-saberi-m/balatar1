<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

/**
 * Class UserResource
 * @package App\Http\Resources\
 */
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
        /** @var User $user */
        $user = auth()->user();
        return [
            'company_id'=>$this->company_id,
            'name'=>$this->name,
            'email'=>$this->email,
            'password'=>$this->password,
            'role'=>$this->role,
            'position'=>$this->position,
            'image'=>Storage::url($this->image),
            'is_approved'=>$this->is_approved,
            'company_is_live'=> $user->company()->exists() && $user->company->is_live
        ];
    }
}