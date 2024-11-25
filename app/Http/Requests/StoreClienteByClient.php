<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClienteByClient extends FormRequest
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
            'email' => ['required', 'string', 'max:255', 'email',
                Rule::unique(table:'cliente', column:'email')->ignore($this->route(param: 'id'),'idcli')],
        ];

        // Evaluar si es una creación o una edición
        if ($this->routeIs('signup')) {
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
            'email.email' => 'El correo electrónico debe de tener una estructura válida.'
        ];
    }
}
