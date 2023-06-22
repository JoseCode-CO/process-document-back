<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El Nombre es requerido.',
            'email.required'  => 'El Email es requerido.',
            'email.email'  => 'El campo debe ser de tipo Email.',
            'email.unique'  => 'El Email que intenta agregar ya está registrado.',
            'password.required'  => 'La contraseña es requerida.',
            'password.min'  => 'La contraseña debe tener minimo 8 caracteres.'
        ];
    }
}
