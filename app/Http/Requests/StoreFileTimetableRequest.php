<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\File;

class StoreFileTimetableRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(\Auth::check() and \Auth::user()->type >= 3) {
            return true;
        }
        else
        {
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
            'file' => 'required'
        ];
    }

    protected function prepareForValidation()
    {
        $text = File::get($this->file);

        if (mb_detect_encoding($text, 'utf-8', true) != true) {
            $text = mb_convert_encoding($text, 'utf-8', 'cp1251');
        }

        $this->merge([
            'text' => $text,
        ]);
    }
}
