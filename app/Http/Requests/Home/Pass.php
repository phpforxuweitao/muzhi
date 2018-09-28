<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

class Pass extends FormRequest
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
            'pass'=>'required|regex:/\w{6,18}/',
            'repass'=>'required|regex:/\w{6,18}/|same:pass'
        ];
    }

    public function messages() {
        return [
            'pass.required'=>'密码不能为空...',
            'pass.regex'=>'密码必须为6-18位的任意数字字母下划线...',
            'repass.required'=>'重复密码不能为空...',
            'repass.regex'=>'重复密码必须为8-16位的任意数字字母下划线...',
            'repass.same'=>'两次密码不一致...'
        ];
    }
}
