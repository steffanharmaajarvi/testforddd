<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedbackRequest extends FormRequest
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
            'name' => 'required|max:255',
            'phone' => 'required|unique:feedback|',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле имя обязательное для заполнения',
            'name.max' => 'Максимальная длина имени 255 символов',
            'phone.unique' => 'Вы уже оставили отзыв',
            'phone.required' => 'Телефон обязателен к заполнению',
            'content.required' => 'Текст отзыва обязателен к заполнению',
        ];
    }
}
