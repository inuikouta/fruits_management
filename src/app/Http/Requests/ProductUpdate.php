<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdate extends FormRequest
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
            'product-name' => 'required',
            'product-price' => 'required|integer|between:0,10000',
            'product-season' => 'required|array',
            'product-desc' => 'required|max:120',
            'product-img' => 'mimes:jpeg,png,jpg,x-png',
            'existing-img' => function ($attribute, $value, $fail) {
                if (!$this->hasFile('product-img') && !$this->input('existing-img')) {
                    $fail('商品画像を登録してください');
                }
            },
        ];
    }

    public function messages()
    {
        return [
            'product-name.required' => '商品名を入力してください',
            'product-price.required' => '値段を入力してください',
            'product-price.integer' => '数値で入力してください',
            'product-price.between' => '0~10000円以内で入力してください',
            'product-img.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
            'product-season.required' => '季節を選択してください',
            'product-desc.required' => '商品説明を入力してください',
            'product-desc.max' => '120文字以内で入力してください',
        ];
    }
}
