<?php

namespace App\Http\Requests\Content;

use Illuminate\Foundation\Http\FormRequest;

class ContentRijiEdit extends FormRequest
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
            'title'     => 'required|max:30',
            'content'   => 'required|regex:/\w+/'
        ];
    }

    public function messages(){
        return [
            'title.required'    => '标题不能为空',
            'title.max'         => '标题不能超过30个字符',
            'content.required'  => '内容不能为空',
            'content.regex'     => '内容不符合规则'
        ];
    }
}
