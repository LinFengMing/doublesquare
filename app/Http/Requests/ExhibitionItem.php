<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionItem extends APIRequest
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
            'date' => 'required|integer',
            'title.tw' => 'required|string',
            'title.en' => 'required|string',
            'artist.tw' => 'required|string',
            'artist.en' => 'required|string',
            'desc.tw' => 'required|string',
            'desc.en' => 'required|string',
            'banner.pc' => 'required|string',
            'banner.mobile' => 'required|string',
            'a.img.src' => 'required|string',
            'a.img.video' => 'required|url',
            'a.img.form' => 'required|boolean',
            'a.desc.tw' => 'required|string',
            'a.desc.en' => 'required|string',
            'a.order' => 'required|integer',
            'b.left_img.src' => 'required|string',
            'b.left_img.video' => 'required|url',
            'b.left_img.form' => 'required|boolean',
            'b.right_img.src' => 'required|string',
            'b.right_desc.tw' => 'required|string',
            'b.right_desc.en' => 'required|string',
            'b.order' => 'required|integer',
            'c.img.src' => 'required|array',
            'c.img.video' => 'required|array',
            'c.img.form' => 'required|array',
            'c.desc.tw' => 'required|string',
            'c.desc.en' => 'required|string',
            'c.order' => 'required|integer',
            'd.left_img.src' => 'required|array',
            'd.left_img.video' => 'required|array',
            'd.left_img.form' => 'required|array',
            'd.left_desc.tw' => 'required|string',
            'd.left_desc.en' => 'required|string',
            'd.middle_img.src' => 'required|array',
            'd.middle_img.video' => 'required|array',
            'd.middle_img.form' => 'required|array',
            'd.middle_desc.tw' => 'required|string',
            'd.middle_desc.en' => 'required|string',
            'd.right_img.src' => 'required|array',
            'd.right_img.video' => 'required|array',
            'd.right_img.form' => 'required|array',
            'd.right_desc.tw' => 'required|string',
            'd.right_desc.en' => 'required|string',
            'd.order' => 'required|integer',
            'e.middle_desc.tw' => 'required|string',
            'e.middle_desc.en' => 'required|string',
            'e.order' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute 是必要的',
            'integer' => ':attribute 的輸入 :input 不是 數值 格式',
            'url' => ':attribute 的輸入 :input 不是 url 格式',
            'boolean' => ':attribute 的輸入 :input 不是 boolean 格式',
            'array' => ':attribute 的輸入 :input 不是 array 格式'
        ];
    }
}
