<?php

namespace App\Http\Requests\BackOffice\Stack;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStackRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'logo' => 'string',
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
            'name.required' => 'Le nom de la stack est requis',
            'name.max' => 'Le nom de la stack est trop long',
            'name.string' => 'Le nom de la stack est invalide',
        ];
    }
}
