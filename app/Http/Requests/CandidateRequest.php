<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidateRequest extends FormRequest
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
            'phone'=>'required|max:12|min:7|numeric',
            'email'=>'required|email',
            'name'=>'required|max:40',
            'company'=>'required|max:40',
            'position'=>'required|max:40',
            'experience'=>'required|size_between:0,50',
            'education'=>'required|max:40',
            'degree'=>'required|max:40',
            'university'=>'required|max:40'
        ];
    }
}
