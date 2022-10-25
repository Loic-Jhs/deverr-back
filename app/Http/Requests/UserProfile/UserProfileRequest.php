<?php

namespace App\Http\Requests\UserProfile;

use Illuminate\Foundation\Http\FormRequest;

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
            'id' => 'integer|exists:users,id',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'id.required' => 'L\'id est requis',
            'id.integer' => 'L\'id doit être un entier',
            'id.exists' => 'L\'id n\'existe pas',
        ];
    }
}
