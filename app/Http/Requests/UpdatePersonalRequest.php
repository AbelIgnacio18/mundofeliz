<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonalRequest extends FormRequest
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
            'nombre'=>'string|max:50|required',
            'apellidos'=>'string|max:100',
         
            'dni'=>'string|max:8|required',
            'celular'=>'max:9',
            'idcargo'=>'required',
            'codigo'=>'string',
        ];
    }
}
