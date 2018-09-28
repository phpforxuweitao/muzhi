<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class UserInsert extends FormRequest
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
             //会员名做规则设置
            'name'=>'required|regex:/\w{2,8}/|unique:users',
            //密码和重复密码
            'pass'=>'required|regex:/\w{6,18}/',
            'repass'=>'required|regex:/\w{6,18}/|same:pass',
            //邮箱
            'email'=>'required|email',
            //电话
            'qq'=>'required|regex:/\d{4,12}/'
        ];
    }

     //自定义错误消息
    public function messages(){
        return[
            'name.required'=>'账号不能为空',
            'name.regex'=>'账号必须为2-8位的任意数字字母下划线',
            'name.unique'=>'账号重复',
            'pass.required'=>'密码不能为空',
            'pass.regex'=>'密码必须为6-18位的任意数字字母下划线',
            'repass.required'=>'重复密码不能为空',
            'repass.regex'=>'重复密码必须为8-16位的任意数字字母下划线',
            'repass.same'=>'两次密码不一致',
            //邮箱
            'email.required'=>'邮箱不能为空',
            'email.email'=>'邮箱格式不符合',
            //QQ
            'qq.required'=>'QQ不能为空',
            'qq.regex'=>'QQ不符合规则'
            ];
    }
}

