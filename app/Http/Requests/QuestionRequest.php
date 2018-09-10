<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'question'=>'required|max:45',
            'answer_1'=>'required|string|max:20',
            'value_1'=>'boolean',
            'answer_2'=>'string|max:20',
            'value_2'=>'boolean',
            'answer_3'=>'string|max:20',
            'value_3'=>'boolean',
            'answer_4'=>'string|max:20',
            'value_4'=>'boolean',
        ];
    }
}
