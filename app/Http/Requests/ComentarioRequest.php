<?php

namespace App\Http\Requests;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ComentarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
       // return false;
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
            'comentario' => 'required|max:250',
            'posteos_id' => 'exists:App\Models\Posteo,id',

        ];
    }

    public function messages()
    {
        return [
            'comentario.required' => 'Es necesario ingresar el comentario',
            'comentario.max' => 'El comentario no puede exceder los 250 caracteres',
            'posteos_id.exists' => 'Debes enviar una publicación válida'
        ];
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException('Debes iniciar sesión para escribir comentarios');
    }



}
