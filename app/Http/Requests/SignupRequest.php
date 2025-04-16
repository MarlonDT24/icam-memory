<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class SignupRequest extends FormRequest
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
            'username' => ['required', 'string', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'El nombre de usuario es obligatorio',
            'username.unique' => 'El nombre de usuario ya existe en el sistema',

            'password.required' => 'La contraseña es obligatoria',
            'password.confirmed' => 'Las contraseñas no coinciden',
        ];
    }
}
