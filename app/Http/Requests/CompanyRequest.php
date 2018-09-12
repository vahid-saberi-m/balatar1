<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
        if ($request->method == 'PUT') {
            return [
                'name' => 'sometimes|max:40|',
                'company_size' => 'sometimes|int|max:10000',
                'slogan' => 'sometimes|max:50|',
                'website' => 'sometimes|max:40|',
                'logo' => 'sometimes|image|max:1000|',
                'message_title' => 'sometimes|max:50|',
                'message_content' => 'sometimes|max:100|',
                'main_photo' => 'sometimes|image|max:2000|',
                'about_us' => 'sometimes|max:1000|',
                'why_us' => 'sometimes|max:1000|',
                'recruiting_steps' => 'sometimes|max:1000|',
                'address' => 'sometimes|max:200|',
                'email' => 'sometimes|max:50||',
                'phone_number' => 'sometimes|int|',
                'location' => 'sometimes|max:40|',
            ];
        }
        return [
            'name' => 'required|max:40|unique:companies',
            'company_size' => 'required|int|max:10000',
            'slogan' => 'required|max:50|',
            'website' => 'required|max:40|',
            'logo' => 'required|image|max:1000|',
            'message_title' => 'required|max:50|',
            'message_content' => 'required|max:1000|',
            'main_photo' => 'required|image|max:2000|',
            'about_us' => 'required|max:2000|',
            'why_us' => 'nullable|max:2000|',
            'recruiting_steps' => 'nullable|max:1000|',
            'address' => 'required|max:200|',
            'email' => 'required|max:50|unique:companies,email|',
            'phone_number' => 'required|int|',
            'location' => 'required|max:40|',
        ];
    }
}
