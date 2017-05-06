<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticuloFormRequest extends FormRequest
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
            'idcategoria'=>'required',
            'codigo'=>'required|numeric',
            'nombre'=>'required|max:45',
            'stock'=>'required|numeric',
            'maximo'=>'required|numeric',
            'minimo'=>'required|numeric',
            'preciov'=>'required',
            'image' => 'mimes:jpeg,png',
        ];
    }
}
