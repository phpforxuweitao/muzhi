<?php

namespace App\Http\Requests\Lunbo;

use Illuminate\Foundation\Http\FormRequest;

class LunboEdit extends FormRequest
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
            'url' => 'required|url'
        ];
    }

    public function messages() {
        return [
            'url.required' => 'url不能为空',
            'url.url' => 'url链接格式不对'
        ];
    }
}
