<?php

namespace App\Http\Requests\AdminUser;

use Illuminate\Foundation\Http\FormRequest;

class AdminInsert extends FormRequest
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
            // 管理名
            'name'=>'required|unique:admin_users',
            // 密码
            'pass'=>'required|regex:/\w{6,18}/'
        ];
    }

     //自定义错误消息
    public function messages(){
        return[
            'name.required'=>'管理员名字不能为空',
            'name.unique'=>'管理员名字重复',
            'pass.required'=>'密码不能为空',
            'pass.regex'=>'密码为6到18位任意字母下划线数字'
            ];
    }
}
