<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * 分类管理的添加和修改规则
 * Class Cates
 * @package App\Http\Requests
 */
class Cates extends FormRequest
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
            'name'  => 'required|unique:cates|max:30'
        ];
    }

    /*
     * 自定义错误信息
     */
    public function messages() {
        return [
            'name.required' => '类名称不能为空',
            'name.unique'   => '类名称已存在',
            'name.max'      => '类名称最多30个字符'
        ];
    }
}
