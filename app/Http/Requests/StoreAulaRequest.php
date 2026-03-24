<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAulaRequest extends FormRequest
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
        'nivel'       => 'required|string|max:100',
        'grado'       => 'required|string|max:100',
        'seccion'     => 'required|string|max:10',

        'vacantes'    => 'required|integer|min:1|max:50',

        // 🔥 Sede
        'idsede'      => 'required|exists:sedes,id',

        // 🔥 Horas
        'horaentrada' => 'required|date_format:H:i:s',
        'horatarde'   => 'required|date_format:H:i:s',
        'horafalta'   => 'required|date_format:H:i:s',
        'horasalida'  => 'required|date_format:H:i:s',
    ];
}

public function withValidator($validator)
{
/*     $validator->after(function ($validator) {

        $user = auth()->user();

        if (!$user->esSuperAdmin()) {
            if (!$user->tieneSede($this->idsede)) {
                $validator->errors()->add('idsede', 'No tienes acceso a esta sede');
            }
        }

        // 🔥 Validar lógica de horas
        if ($this->horaentrada < $this->horatarde) {
            $validator->errors()->add('horatarde', 'Debe ser mayor que la hora de entrada');
        }

        if ($this->horatarde < $this->horafalta) {
            $validator->errors()->add('horafalta', 'Debe ser mayor que la hora de tardanza');
        }

        if ($this->horafalta < $this->horasalida) {
            $validator->errors()->add('horasalida', 'Debe ser mayor que la hora de falta');
        }
    }); */
}
public function messages(): array
{
    return [
        'idsede.required' => 'Debe seleccionar una sede',
        'idsede.exists'   => 'La sede no es válida',

        'horaentrada.required' => 'Ingrese hora de entrada',
        'horasalida.required'  => 'Ingrese hora de salida',

        'vacantes.required' => 'Ingrese número de vacantes',
    ];
}
}
