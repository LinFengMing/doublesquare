<?php

namespace App\Http\Requests;

//use Illuminate\Foundation\Http\FormRequest;

class UpdateParm extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'footer_exhibition' => 'required|string|url',
            'footer_artist' => 'required|string|url'
        ];
    }

    public function messages()
    {
        return [
            'footer_exhibition' => '必填',
            'footer_artist' => '必填'
        ];
    }
}
