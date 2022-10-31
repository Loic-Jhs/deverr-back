<?php

namespace App\Http\Requests\BackOffice;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\File;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('isAdmin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email:dns|max:255|unique:users,email',
            'experience' => 'integer|required_if:type,developer|max:35',
            'description' => 'string|required_if:type,developer|max:500',
            'avatar' => [
                File::types(['png', 'jpg', 'svg']),
            ],
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
            'email.required' => "L'email est requis",
            'email.unique' => "L'email est déjà pris",
            'email.email' => "L'email est invalide",
            'email.max' => "L'email est trop long",
            'firstname.required' => 'Le prénom est requis',
            'lastname.required' => 'Le nom est requis',
            'experience.required_if' => "L'expérience est requise",
            'experience.max' => "L'expérience est trop longue",
            'experience.integer' => "L'expérience doit être un nombre",
            'description.required_if' => 'La description est requise',
            'description.max' => 'La description est trop longue',
        ];
    }
}
