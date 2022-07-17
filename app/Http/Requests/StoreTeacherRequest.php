<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Auth\Middleware\AuthenticatesRequests;
use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (\Auth::user()->type == 4) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'numeric|nullable',
            'first_name' => 'string|max:50|nullable',
            'second_name' => 'string|max:50|nullable',
            'middle_name' => 'string|max:50|nullable',
            'lessons' => 'json|nullable',
            'type' => 'string|max:50|nullable',
            'class' => 'numeric|nullable',
        ];
    }
}
