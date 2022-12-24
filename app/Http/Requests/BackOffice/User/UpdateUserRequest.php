<?php

namespace App\Http\Requests\BackOffice;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class UpdateUserRequest extends FormRequest
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
    public function rules(Request $request): array
    {
        return [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255', Rule::unique('users')->ignore($request->email, 'email')],
            'experience' => 'required_if:type,developer|max:80',
            'description' => 'required_if:type,developer|max:500',
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
            'email.unique' => "L'email est déjà pris",
            'email.email' => "L'email est invalide",
            'email.required' => "L'email est requis",
            'email.max' => "L'email est trop long",
            'firstname.required' => 'Le prénom est requis',
            'lastname.required' => 'Le nom est requis',
            'experience.required_if' => "L'expérience est requise",
            'description.required_if' => 'La description est requise',
        ];
    }
}
