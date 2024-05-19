<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class ValidarUsuarioCreate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // valido las propiedades de las tablas para que los datos tengan consistencia e integridad
            'id'=> ['required', 'unique:usuarios,usuario_id'],
            'nombre'=>'required',
            'departamento'=> 'required'
        ];
    }
    public function messages(): array
    {
        return [
           // mensajes personalizados para orientra al usuario
            'id'=> 'El campo "id" es obligatorio',
            'id.unique'=>'el campo id ya existe',
            'nombre'=>'El campo "nombre" es obligatorio',
            'departamento'=> 'El campo "departamento" es obligatorio'
        ];
    }

}