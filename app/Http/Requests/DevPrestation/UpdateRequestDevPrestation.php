<?php

namespace App\Http\Requests\DevPrestation;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequestDevPrestation extends FormRequest
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

    public function rules(): array
    {
        return [
            'prestation_type_id' => 'nullable|exists:prestation_types,id',
            'description' => 'nullable|string|max:255',
            'price' => 'nullable|int',
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
            'description.required' => 'La description est obligatoire',
            'description.string' => 'La description doit être une chaîne de caractères',
            'description.max' => 'La description ne doit pas dépasser 255 caractères',
            'prestation_type_id.required' => 'Le type de prestation est obligatoire',
            'prestation_type_id.exists' => 'Le type de prestation n\'existe pas',
            'price.required' => 'Le prix est obligatoire',
            'price.int' => 'Le prix doit être un nombre entier',
        ];
    }
}
