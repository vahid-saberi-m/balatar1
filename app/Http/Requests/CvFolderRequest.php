<?php

namespace App\Http\Requests;

use App\Models\JobPost;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CvFolderRequest extends FormRequest
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
            "name" => 'required|max:30'
        ];
    }
}
