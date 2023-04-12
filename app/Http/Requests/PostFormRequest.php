<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|max:50',
            'start_datetime' => 'required',
            'end_datetime' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '必須です',
            'title.max' => '50文字以内です',
            'start_datetime.required' => '必須です',
            'end_datetime.required' => '必須です',
        ];
    }
}
