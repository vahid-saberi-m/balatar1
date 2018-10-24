<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (auth()->user()->role == 'admin');
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
                'title' => 'sometimes|max:150',
                'content' => 'sometimes|max:2000',
                'main_photo' => 'sometimes|file|image|between:1,2000',
                'tags' => 'sometimes|max:255',
            ];
        } else {
            return [
                'title' => 'required|max:150',
                'content' => 'required|max:2000',
                'main_photo' => 'required|file|image|between:1,2000',
                'tags' => 'sometimes|max:255',
            ];
        }
    }
}
