<?php

namespace App\Http\Requests\DevPrestation;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequestDevPrestation extends FormRequest
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
            'description' => 'required|string|max:255',
            'prestation_type_id' => 'required|exists:prestation_types,id',
            'price' => 'required|int',
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
