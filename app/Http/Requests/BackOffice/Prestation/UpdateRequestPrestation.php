<?php

namespace App\Http\Requests\Backoffice\Prestation;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequestPrestation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
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
            'name.required' => 'Le nom de la prestation est requis',
            'name.max' => 'Le nom de la prestation est trop long',
            'name.string' => 'Le nom de la prestation est invalide',
        ];
    }
}
