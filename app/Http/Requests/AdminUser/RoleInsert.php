<?php

namespace App\Http\Requests\AdminUser;

use Illuminate\Foundation\Http\FormRequest;

class RoleInsert extends FormRequest
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
            // 角色名
            'name'=>'required|unique:role',
        ];
    }

      //自定义错误消息
    public function messages(){
        return[
            'name.required'=>'角色名不能为空',
            'name.unique'=>'角色名重复'
            ];
    }
}
