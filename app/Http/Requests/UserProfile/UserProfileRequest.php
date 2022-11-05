<?php

namespace App\Http\Requests\UserProfile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserProfileRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'firstname' => 'nullable|string',
            'lastname' => 'nullable|string',
            'email' => ['nullable', 'email', Rule::unique('users')->ignore($this->user()->id)],
            'description' => 'nullable|string',
            'years_of_experience' => 'nullable|integer',
            'avatar' => 'nullable|url',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'firstname.string' => 'Le prénom doit être une chaîne de caractères',
            'lastname.string' => 'Le nom doit être une chaîne de caractères',
            'email.email' => 'L\'email doit être une adresse email valide',
            'email.unique' => 'L\'email est déjà utilisé',
            'description.string' => 'La description doit être une chaîne de caractères',
            'years_of_experience.integer' => 'L\'année d\'expérience doit être un nombre',
            'avatar.url' => 'L\'avatar doit être une URL valide',
        ];
    }
}
