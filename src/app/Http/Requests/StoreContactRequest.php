<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'last_name'   => ['required', 'string', 'max:255'],
            'first_name'  => ['required', 'string', 'max:255'],
            'email'       => ['required', 'email'],
            'content'     => ['required', 'string'],
            'channels'    => ['nullable', 'array'],
            'channels.*'  => ['integer', 'exists:channels,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'channels.array' => 'どこで知りましたかは配列で送信される必要があります。',
            'channels.*.exists' => '選択された項目が不正です。',
        ];
    }
}
