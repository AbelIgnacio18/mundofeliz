<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAulaRequest extends FormRequest
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
        'vacantes'    => 'required|integer|min:1|max:50',

        'horaentrada' => 'required|date_format:H:i:s',
        'horatarde'   => 'required|date_format:H:i:s',
        'horafalta'   => 'required|date_format:H:i:s',
        'horasalida'  => 'required|date_format:H:i:s',
    ];
}
public function withValidator($validator)
{
    $validator->after(function ($validator) {

        if ($this->horaentrada >= $this->horatarde) {
            $validator->errors()->add('horatarde', 'Debe ser mayor que hora entrada');
        }

        if ($this->horatarde >= $this->horafalta) {
            $validator->errors()->add('horafalta', 'Debe ser mayor que hora tardanza');
        }

        if ($this->horafalta >= $this->horasalida) {
            $validator->errors()->add('horasalida', 'Debe ser mayor que hora falta');
        }
    });
}
}
