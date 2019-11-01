<?php

namespace App\Http\Resources\Application;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationCommentsResource extends JsonResource
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
            'user'=>$this->user->name,
            'content'=> $this->content,
            'created_at'=> Carbon::parse( $this->created_at)->format('y/m/d'),
            'ratings'=> ApplicationRatingsResource::collection($this->applicationRatings)
        ];
    }
}
