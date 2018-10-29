<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            'id'=>$this->id,
            'question'=>$this->question,
            'answer_1'=>$this->answer_1,
            'answer_2'=>$this->answer_2,
            'answer_3'=>$this->answer_3,
            'answer_4'=>$this->answer_4,
            ];
    }
}
