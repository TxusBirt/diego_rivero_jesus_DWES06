<?php

namespace App\Http\Requests;


use App\Rules\NoNulo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class ValidarUsuarioUpdate extends FormRequest
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
            'id'=> new NoNulo(),
            'nombre'=>new NoNulo(),
            'departamento'=> new NoNulo()
        ];
    }
    public function messages(): array
    {
        return [
           // mensajes personalizados para orientra al usuario
            
        
        ];
    }

}