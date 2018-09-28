<?php

namespace App\Http\Requests\AdminUser;

use Illuminate\Foundation\Http\FormRequest;

class NodeInsert extends FormRequest
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
            // 权限名
            'name'=>'required|unique:node',
            // 控制器名
            'mname'=>'required|regex:/\w{2,50}/',
            // 方法名
            'aname'=>'required|regex:/\w{2,50}/'
        ];
    }

     //自定义错误消息
    public function messages(){
        return[
            'name.required'=>'权限名不能为空',
            'name.unique'=>'权限名重复',
            'mname.required'=>'控制器名不能为空',
            'mname.regex'=>'控制器名不符合规则',
            'aname.required'=>'方法名不能为空',
            'aname.regex'=>'方法名不符合规则'
            ];
    }
}
