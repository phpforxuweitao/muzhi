<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdate extends FormRequest
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
            //邮箱
            'email'=>'required|email',
            //电话
            'qq'=>'required|regex:/\d{4,12}/',
            // 积分
            'score'=>'required|regex:/\d+/'
        ];
    }

    //自定义错误消息
    public function messages(){
        return[
            //邮箱
            'email.required'=>'邮箱不能为空',
            'email.email'=>'邮箱格式不符合',
            //QQ
            'qq.required'=>'QQ不能为空',
            'qq.regex'=>'QQ不符合规则',
            //积分
            'score.required'=>'积分不能为空',
            'score.regex'=>'积分不符合规则'

            ];
    }
}
