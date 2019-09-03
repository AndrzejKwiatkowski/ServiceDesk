<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSolution extends FormRequest
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
                'solution' => 'required|min:16|max:1000',

        ];
    }
    public function messages()
    {
        return [
            'body.required' => 'Pole wymagane.',
            'body.min' => 'Wymagana ilość znaków 16.',
            'body.max' => 'Maksymalna ilość znaków 1000.',


        ];
    }
}
