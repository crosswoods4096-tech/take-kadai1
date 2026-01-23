<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
         'last_name' => 'required|string|max:255',
         'first_name' => 'required|string|max:255',
         'email' => 'required|string|email|max:255',
         'tel_1' => 'required|numeric|digits_between:2,3',
         'tel_2' => 'required|numeric|digits_between:4,4',
         'tel_3' => 'required|numeric|digits_between:4,4',
         'address' => 'required|string|max:255',
        ];
    }
    public function messages()
     {
         return [
             'last_name.required' => '名字を入力してください',
             'last_name.string' => '名字を文字列で入力してください',
             'last_name.max' => '名字を255文字以下で入力してください',
             'first_name.required' => '名前を入力してください',
             'first_name.string' => '名前を文字列で入力してください',
             'first_name.max' => '名前を255文字以下で入力してください',
             'email.required' => 'メールアドレスを入力してください',
             'email.string' => 'メールアドレスを文字列で入力してください',
             'email.email' => '有効なメールアドレス形式を入力してください',
             'email.max' => 'メールアドレスを255文字以下で入力してください',
             'tel_1.required' => '市外局番を入力してください',
             'tel_1.numeric' => '市外局番を数値で入力してください',
             'tel_1.digits_between' => '市外局番を2桁から3桁の間で入力してください',
             'tel_2.required' => '電話番号を入力してください',
             'tel_2.numeric' => '電話番号を数値で入力してください',
             'tel_2.digits_between' => '電話番号を4桁で入力してください',
             'tel_3.required' => '電話番号を入力してください',
             'tel_3.numeric' => '電話番号を数値で入力してください',
             'tel_3.digits_between' => '電話番号を4桁で入力してください',
             'address.required' => '住所を入力してください',
             'address.string' => '住所を文字列で入力してください',
             'address.max' => '住所を255文字以下で入力してください',
         ];
     }
}
