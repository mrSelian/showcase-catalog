<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'customer' => ['required', 'string', 'max:60'],
            'phone' => ['required', 'max:15'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'customer.required' => 'ФИО обязательно для заполнения.',
            'customer.string' => 'ФИО должно быть текстом.',
            'customer.max' => 'ФИО не может быть длинее 60 символов.',
            'phone.required' => 'Номер телефона обязателен для заполнения.',
            'phone.max' => 'Телефон не может быть длинее 15 символов.',
        ];
    }

    protected function getRedirectUrl()
    {
        return url()->previous() . '#form';
    }
}
