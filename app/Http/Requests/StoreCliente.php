<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCliente extends FormRequest
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
            'am' => 'nullable|string|max:255',
            'genero' => 'nullable|in:Femenino,Masculino,Otro',
            'direccion' => 'nullable|string|max:255',
            'fenac' => 'nullable|date',
            'telefono' => ['nullable','string','max:255','regex:/^[0-9]+$/',
                Rule::unique(table:'cliente', column:'telefono')->ignore($this->route(param: 'id'),'idcli')],
            'email' => ['required', 'string', 'max:255', 'email',
                Rule::unique(table:'cliente', column:'email')->ignore($this->route(param: 'id'),'idcli')],
        ];

        // Evaluar si es una creación o una edición
        if ($this->routeIs('cliente.store')) {
            // Validaciones para la creación (contraseña es obligatoria)
            $rules['contrasena'] = 'required|string|min:8';
        } else {
            // Validaciones para la edición (contraseña opcional)
            $rules['contrasena'] = 'nullable|string|min:8';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'telefono.regex' => 'El número de teléfono solo puede contener dígitos.',
            'email.email' => 'El correo electrónico debe de tener una estructura válida.',
        ];
    }
}
