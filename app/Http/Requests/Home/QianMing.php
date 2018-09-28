<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

class QianMing extends FormRequest
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
            'sign' => 'required|max:200'
        ];
    }

    public function messages() {
        return [
            'sign.required' => '个性签名内容不能为空',
            'sign.max' => '内容字符不能超过200个字符'
        ];
    }
}
