<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePromocion extends FormRequest
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
            'codigo' => ['required','string','max:10',
                Rule::unique(table:'promocion', column:'codigo')->ignore($this->route(param: 'id'),'idprom')],
            'descuento' => 'required|numeric|min:0.05', 
            'dias' => 'required|string|max:255', 
            'descripcion' => 'required|string|max:255',
            'estatus' => 'required|in:Activa,Inactiva'
        ];
    }
}
