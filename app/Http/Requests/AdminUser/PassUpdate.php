<?php

namespace App\Http\Requests\AdminUser;

use Illuminate\Foundation\Http\FormRequest;

class PassUpdate extends FormRequest
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
            //密码
            'pass'=>'required|regex:/\w{6,18}/',
            'newpass'=>'required|regex:/\w{6,18}/',
            'repass'=>'required|regex:/\w{6,18}/|same:newpass'
        ];
    }

     //自定义错误消息
    public function messages(){
        return[
            'pass.required'=>'旧密码不能为空',
            'pass.regex'=>'旧密码不符合规则',
            'newpass.required'=>'新密码不能为空',
            'newpass.regex'=>'密码为6到18位任意字母下划线数字',
            'repass.required'=>'确认密码不能为空',
            'repass.regex'=>'密码为6到18位任意字母下划线数字',
            'repass.same'=>'两次密码不一致'
            ];
    }
}
