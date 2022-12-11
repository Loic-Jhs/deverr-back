<?php

namespace App\Http\Requests\LoginRegister;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ];
    }

    public function messages(): array
    {
        return [
            'token.required' => 'Le token est requis',
            'email.required' => 'L\'email est requis',
            'email.email' => 'L\'email n\'est pas valide',
            'password.required' => 'Le mot de passe est requis',
            'password.confirmed' => 'Les mots de passe ne correspondent pas',
            'password_confirmation.required' => 'La confirmation du mot de passe est requise',
            'password_confirmation.same' => 'Les mots de passe ne correspondent pas',
        ];
    }
}
