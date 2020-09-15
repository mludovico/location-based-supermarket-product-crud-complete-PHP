<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
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
            'aisle'=>'required|regex:/^[A-z]$/',
            'shelf'=>'required|numeric',
            'side'=>'required|regex:/^[e,E,d,D]$/'
        ];
    }
    public function messages()
    {
      return [
        'aisle.required'=>'Você deve especificar um corredor.',
        'aisle.regex'=>'Formato do campo corredor inválido. Tente um valor de A - Z.',
        'shelf.required'=>'Você deve especificar uma prateleira.',
        'shelf.numeric'=>'Formato do campo prateleira inválido. Tente um valor numérico.',
        'side.required'=>'Você deve especificar um lado.',
        'side.regex'=>'Formato do campo lado inválido. Especifique E (esquerdo) ou D (direito).'
      ];
    }
}
