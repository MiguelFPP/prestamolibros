<?php

namespace App\Http\Requests\Admin;

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
            'identification' => 'required|unique:users,identification',
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'identification' => 'Identificación',
            'name' => 'Nombre',
            'surname' => 'Apellido',
            'email' => 'Correo electrónico',
            'role' => 'Rol',
        ];
    }
}
