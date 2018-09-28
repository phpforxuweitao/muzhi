<?php

namespace App\Http\Requests\Msg;

use Illuminate\Foundation\Http\FormRequest;

class Msg extends FormRequest
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
            'nickname' => 'required|max:20',
            'birthday' => 'required',
            'qq'       => 'required'
        ];
    }

    public function messages() {
        return [
            'nickname.required' => '昵称不能为空',
            'nickname.max'      => '昵称不能超过20个字符',
            'birthday.required' => '出生日期不能为空',
            'qq.required' => 'qq不能为空'
        ];
    }
}
