<?php

namespace App\Http\Requests\Ads;

use Illuminate\Foundation\Http\FormRequest;

class Ads extends FormRequest
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
            'name'      => 'required|unique:advertising|max:30',
            'pic'       => 'required',
            'url'       => 'required|url',
            'pos'       => 'required'
        ];
    }

    public function messages() {
        return [
            'name.required'      => '广告名称不能为空',
            'name.unique'        => '广告名称已存在',
            'name.max'           => '广告名称不能超过30个字符',
            'pic.required'       => '图片链接必须添加',
            'url.required'       => '广告链接必须添加',
            'url.url'            => '广告链接格式不符合',
            'pos.required'       => '广告位置必须添加'
        ];
    }
}
