<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttachment extends FormRequest
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

            'plik' => 'required|mimes:pdf,jpeg,bmp,png|max:1024'
        ];
    }

    public function messages()
    {
        return [
            'plik.mimes' => 'Załacznik może posiadać format pdf, jpeg, bmp, png.',
            'plik.max' => 'Załacznik nie może przekraczac 1MB pojemności.',
            ];
    }
}
