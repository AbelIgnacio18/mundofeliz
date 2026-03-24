<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateAdministrativoRequest extends FormRequest
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
       

'email' => [
    'required',
    'email',
    Rule::unique('users', 'email')->ignore($this->route('administradore')),
],
        'userrol_id' => 'required|array',
        'sedes' => 'nullable|array'
    ];
}

public function withValidator($validator)
{
    $validator->after(function ($validator) {

        $roles = $this->userrol_id ?? [];

        $esSuperAdmin = \App\Models\Rol::whereIn('id', $roles)
            ->where('nombre', 'SuperAdmin')
            ->exists();

        if (!$esSuperAdmin && empty($this->sedes)) {
            $validator->errors()->add('sedes', 'Debe asignar al menos una sede');
        }
    });
}

public function messages(): array
{
    return [
        'email.unique' => 'El email ya está en uso',

        'userrol_id.required' => 'Debe seleccionar un rol',

        'sedes.required' => 'Debe asignar al menos una sede',
    ];
}

}
