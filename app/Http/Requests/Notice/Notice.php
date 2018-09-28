<?php

namespace App\Http\Requests\Notice;

use Illuminate\Foundation\Http\FormRequest;

class Notice extends FormRequest
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
            'title' => 'required|max:50',
            'content' => 'required'
        ];
    }

    //自定义错误信息
    public function messages() {
        return [
            'title.required' => '公告标题不能为空',
            'title.max' => '公告标题不能超过50个字符',
            'content.required' => '公告内容不能为空'
        ];
    }
}
