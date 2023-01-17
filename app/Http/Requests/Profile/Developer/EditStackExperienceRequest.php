<?php

namespace App\Http\Requests\Profile\Developer;

use Illuminate\Foundation\Http\FormRequest;

class EditStackExperienceRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'stack_experience' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'stack_experience.required' => "L'expérience est obligatoire",
            'stack_experience.integer' => "L'expérience doit être un nombre entier",
        ];
    }
}
