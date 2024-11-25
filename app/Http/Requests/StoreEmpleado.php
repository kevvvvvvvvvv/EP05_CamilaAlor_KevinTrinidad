<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEmpleado extends FormRequest
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
    public function rules()
    {
        $rules = [
            'nombre' => 'required|string|max:255',
            'ap' => 'required|string|max:255',
            'am' => 'required|string|max:255',
            'genero' => 'nullable|in:Femenino,Masculino,Otro',
            'fenac' => 'nullable|date',
            'feIng' => 'required|date',
            'direccion' => 'nullable|string|max:255',
            'telefono' => ['nullable','string','max:255','regex:/^[0-9]+$/',
                Rule::unique(table:'empleado', column:'telefono')->ignore($this->route(param: 'id'),'ide')],
            'email' => ['required', 'string', 'max:255', 'email',
                Rule::unique(table:'empleado', column:'email')->ignore($this->route(param: 'id'),'ide')],
        ];

        // Evaluar si es una creación o una edición
        if ($this->routeIs('empleado.store')) {
            // Validaciones para la creación (contraseña es obligatoria)
            $rules['contrasena'] = 'required|string|min:8';
        } else {
            // Validaciones para la edición (contraseña opcional)
            $rules['contrasena'] = 'nullable|string|min:8';
        }

        return $rules;
    }
}
