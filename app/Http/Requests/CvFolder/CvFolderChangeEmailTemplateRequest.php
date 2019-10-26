<?php

namespace App\Http\Requests\CvFolder;

use Illuminate\Foundation\Http\FormRequest;

class CvFolderChangeEmailTemplateRequest extends FormRequest
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
            'email_template'=>'required|max:1000'
        ];
    }
}
