<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreAnnouncementsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (\Auth::check()) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'main_text' => 'required|string',
            'type' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'main_text.required' => 'Поле "Текст объяваления" обязательно для заполненмя',
            'main_text.string' => 'Поле "Текст объявления должно быть строкой',
            'title.required' => 'Поле "Заголовок" обязательно для заполнения',
            'title.string' => 'Поле "Заголовок" должно быть строкой',
            'type.required' => 'Поле "Класс" обязательно для заполнения',
            'type.string' => 'Неизвестная ошибка',
        ];
    }

    protected function prepareForValidation() {
        $this->merge([
           'main_text' => strip_tags($this->main_text, '<p><strong><em><span><ol><li><ul><a>'),
        ]);
    }
}
