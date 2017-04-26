<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonaFromRequest extends FormRequest
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
            'doc_persona'=>'required|max:100',
            'nombre_persona'=>'required|max:60',
            'direccion'=>'required|max:85',
            'telefono'=>'required|max:12',
            'email'=>'required|max:65',
        ];
    }
}
