<?php

namespace App\Http\Requests\LoginRegister;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'experience' => 'required_if:type,developer|max:80',
            'description' => 'required_if:type,developer|max:500',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'firstname.required' => 'Le prénom est requis',
            'firstname.max' => 'Le prénom est trop long',
            'firstname.string' => 'Le prénom est invalide',
            'lastname.required' => 'Le nom est requis',
            'lastname.max' => 'Le nom est trop long',
            'lastname.string' => 'Le nom est invalide',
            'email.required' => "L'email est requis",
            'email.string' => "L'email est invalide",
            'email.email' => "L'email est invalide",
            'email.max' => "L'email est trop long",
            'email.unique' => "L'email est déjà pris",
            'password.required' => 'Le mot de passe est requis',
            'password.string' => 'Le mot de passe est invalide',
            'password.min' => 'Le mot de passe est trop court',
            'experience.required_if' => "L'expérience est requise",
            'experience.max' => "L'expérience est trop longue",
            'description.required_if' => 'La description est requise',
            'description.max' => 'La description est trop longue',
        ];
    }
}
