<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdministrativoRequest extends FormRequest
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
        'name' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',

        // roles
        'userrol_id' => 'required|array',
        'userrol_id.*' => 'exists:rols,id',

        // 🔥 sedes
        'sedes' => 'required|array',
        'sedes.*' => 'exists:sedes,id',

        // imagen
        'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ];
    
}
public function messages(): array
{
    return [
        'name.required' => 'El nombre es obligatorio',
        'apellidos.required' => 'Los apellidos son obligatorios',
        'email.required' => 'El email es obligatorio',
        'email.unique' => 'El email ya está registrado',

        'password.required' => 'La contraseña es obligatoria',
        'password.confirmed' => 'Las contraseñas no coinciden',

        'userrol_id.required' => 'Debe seleccionar al menos un rol',

        // 🔥 sedes
        'sedes.required' => 'Debe asignar al menos una sede',
        'sedes.*.exists' => 'La sede seleccionada no es válida',
    ];
}
}
