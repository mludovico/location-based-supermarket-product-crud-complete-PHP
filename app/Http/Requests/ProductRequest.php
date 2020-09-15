<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product'=>'required',
            'location'=>'required|numeric',
            'price'=>'required|numeric'
        ];
    }

    public function messages()
    {
      return [
        'product.required'=>'Especifique um produto.',
        'location.required'=>'Especifique uma localização.',
        'location.numeric'=>'Formato do campo localização inválido.',
        'price.required'=>'Especifique um preço',
        'price.numeric'=>'Formato inválido do campo Preço. Insira um valor numérico separando casas decimais por . (ponto).'
      ];
    }
}
