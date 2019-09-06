<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicket extends FormRequest
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
            'title' => 'required|min:8|max:255',
            'body' => 'required|min:16|max:1000',
        ];
    }
    public function messages()
    {
         return [
        //     'title.required' => 'Pole wymagane.',
        //     'title.min' => 'Wymagana ilość znaków 16.',
        //     'title.max' => 'Maksymalna ilość znaków 255.',

        //     'body.required' => 'Pole wymagane.',
        //     'body.min' => 'Wymagana ilość znaków 16.',
        //     'body.max' => 'Maksymalna ilość znaków 1000.',
         ];
    }
}
