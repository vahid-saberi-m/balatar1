<?php

namespace App\Http\Requests;

use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class ApplicationRequest extends FormRequest
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
    public function rules(Request $request)
    {
        if ($request->file('cv')) {
            return [
                'email' => 'required|max:50|email',
                'phone' => 'required|int',
                'cv' => 'required|max:2000|mimes:pdf',
                'name' => 'required|max:30|string',
                'company' => 'required|max:30|string',
                'position' => 'required|max:30|string',
                'experience' => 'required|max:30|int',
                'education' => 'required|max:30|string',
                'degree' => 'required|max:30|string',
                'university' => 'required|max:30|string'
            ];
        } else {
            return [
                'email' => 'required|max:50|email',
                'phone' => 'required|int',
                'cv_id' => 'required|int',
                'name' => 'required|max:30|string',
                'company' => 'required|max:30|string',
                'position' => 'required|max:30|string',
                'experience' => 'required|max:30|int',
                'education' => 'required|max:30|string',
                'degree' => 'required|max:30|string',
                'university' => 'required|max:30|string'
            ];
        }
    }
}
