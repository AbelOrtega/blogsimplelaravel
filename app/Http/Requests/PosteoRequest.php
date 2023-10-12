<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PosteoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //return false;
        return Auth::check();

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => 'required|max:150',
            'contenido' => 'required|max:500',
        ];
    }

    public function messages()
    {
        return [
            'titulo.required' => 'Se requiere un Titulo',
            'titulo.max' => 'El Titulo no debe exceder los 150 caracteres',
            'contenido.required' => 'El posteo debe tener contenido adicional',
            'contenido.max' => 'El contenido no debe exceder los 500 caracteres',
        ];
    }
    
}
