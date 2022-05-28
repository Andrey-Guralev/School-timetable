<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeedbackRequest extends FormRequest
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
            'first_name' => 'string|max:50|required',
            'second_name' => 'string|max:50|required',
            'class' => 'numeric|integer|required',
            'text' => 'string|max:300|required'
        ];
    }

    public function attributes()
    {
        return [
            'first_name' => 'Имя',
            'second_name' => 'Фамилия',
            'class_name' => 'Класс',
            'text' => 'Текст',

        ];
    }
}
