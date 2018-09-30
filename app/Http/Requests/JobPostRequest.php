<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class JobPostRequest extends FormRequest
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
            'title' => 'required|max:155',
            'summary' => 'sometimes|max:255',
            'description' => 'required|max:255',
            'requirements' => 'sometimes|max:255',
            'benefits' => 'sometimes|max:255',
            'location' => 'required|max:255',
            'publish_date' => 'required|after_or_equal:today',
            'expiration_date'=>'required|after_or_equal:publish_date',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'A title is required',
            'body.required'  => 'A message is required',
            'after_or_equal:today'  => 'روز انتشار نمی تواند تاریخی قبل از امروز داشته باشد.',
        ];
    }

}
