<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // if ($this->path() == 'hello') {
        //     return true;
        // }
        // dd($this->path());
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
            'quantity' => 'required|numeric',
        ];
    }


    /**
     * バリデーションによるエラーメッセージ
     */
    public function messages()
    {
        return [
            'quantity.required' => '数量は必ず指定してください。',
            'quantity.numeric' => '数量は数値で指定してください。'
        ];
    }
}
