<?php

namespace App\Http\Requests\Links;

use Illuminate\Foundation\Http\FormRequest;

class Links extends FormRequest
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
            'name'   => 'required|unique:links|max:30',
            'url'    => 'required|unique:links|url'
        ];
    }

    //自定义错误消息
    public function messages(){
        return[
            'name.required'   =>'链接名称不能为空   ',
            'name.unique'     =>'链接名称已经存在   ',
            'name.max'        =>'链接名称不能超过30个字符   ',
            'url.required'    =>'url不能为空   ',
            'url.url'         =>'url格式不对   ',
            'url.unique'      =>'链接url已经存在   '
        ];
    }
}
