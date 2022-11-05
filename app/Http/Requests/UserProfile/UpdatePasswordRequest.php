<?php

namespace App\Http\Requests\UserProfile;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'current_password' => 'required|exists:users,password',
            'new_password' => 'required|min:6',
            'new_password_confirmation' => 'required|same:new_password',
        ];
    }

    public function messages()
    {
        return [
            'current_password.exists' => 'Le mot de passe actuel est incorrect',
            'new_password.min' => 'Le nouveau mot de passe doit contenir au moins 6 caractères',
            'new_password_confirmation.confirmed' => 'Les mots de passe ne correspondent pas',
        ];
    }
}
