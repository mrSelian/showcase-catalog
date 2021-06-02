<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:30'],
            'price' => ['required', 'min:1', 'integer'],
            'oldPrice' => ['min:1'],
            'amount' => ['required', 'min:1', 'integer'],
            'brand' => ['required', 'max:30'],
            'liquid' => ['boolean'],
            'hard' => ['boolean'],
            'wet' => ['boolean'],
            'warm' => ['boolean'],
            'photo1' => ['required', 'mimes:jpg,png,jpeg'],
            'photo2' => ['mimes:jpg,png,jpeg'],
            'photo3' => ['mimes:jpg,png,jpeg'],
            'photo4' => ['mimes:jpg,png,jpeg'],
            'photo5' => ['mimes:jpg,png,jpeg']
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
            'title.required' => 'Название обязательно для заполнения.',
            'price.required' => 'Цена обязательна для заполнения.',
            'brand.required' => 'Бренд обязателен для заполнения.',
            'amount.required' => 'Количество обязательно для заполнения.',
            'amount.min' => 'Количество не может быть меньше 1.',
            'photo1.required' => 'Основное фото обязательно.',
            'price.integer' => 'Цена должна быть числом.',
            'price.min' => 'Цена не может быть меньше 1.',
            'amount.integer' => 'Количество должно быть числом.',
            'photo1.mimes' => 'Фото должно иметь одно из следующих разрешений: jpg, png, jpeg.',
            'photo2.mimes' => 'Фото должно иметь одно из следующих разрешений: jpg, png, jpeg.',
            'photo3.mimes' => 'Фото должно иметь одно из следующих разрешений: jpg, png, jpeg.',
            'photo4.mimes' => 'Фото должно иметь одно из следующих разрешений: jpg, png, jpeg.',
            'photo5.mimes' => 'Фото должно иметь одно из следующих разрешений: jpg, png, jpeg.',
        ];
    }
}
