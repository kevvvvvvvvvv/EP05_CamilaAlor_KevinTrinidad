<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAlmacenaje extends FormRequest
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
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255', 
            'fechaIng' => 'required|date',
            'fechaCad' => 'nullable|date|after:fechaIng',
            'cantidad' => 'required|integer|min:1',
            'categoria' => 'required|string|max:255'
        ];
    }

    public function messages()
    {
        return [
            'fechaCad.after' => 'La fecha de caducidad debe ser mayor que la fecha de ingreso.',
        ];
    }
}
