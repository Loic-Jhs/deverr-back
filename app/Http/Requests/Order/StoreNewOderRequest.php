<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewOderRequest extends FormRequest
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
            'developer_id' => 'required|integer|exists:developers,id',
            'developer_prestation_id' => 'required|integer|exists:developer_prestations,id',
            'instructions' => 'string|max:1500',
            'is_paid' => 'boolean',
            'is_accepted_by_developer' => 'boolean',
            'stripe_session_id' => 'string',
            'reference' => 'string',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'Le champ user_id est obligatoire',
            'user_id.integer' => 'Le champ user_id doit être un entier',
            'user_id.exists' => 'Le champ user_id doit correspondre à un utilisateur existant',
            'developer_id.required' => 'Le champ developer_id est obligatoire',
            'developer_id.integer' => 'Le champ developer_id doit être un entier',
            'developer_id.exists' => 'Le champ developer_id doit correspondre à un développeur existant',
            'developer_prestation_id.required' => 'Le champ developer_prestation_id est obligatoire',
            'developer_prestation_id.integer' => 'Le champ developer_prestation_id doit être un entier',
            'developer_prestation_id.exists' => 'Le champ developer_prestation_id doit correspondre à une prestation existante',
            'instructions.string' => 'Le champ instructions doit être une chaîne de caractères',
            'instructions.max' => 'Le champ instructions doit contenir au maximum 1500 caractères',
            'is_paid.boolean' => 'Le champ is_paid doit être un booléen',
            'is_accepted_by_developer.boolean' => 'Le champ is_accepted_by_developer doit être un booléen',
            'stripe_session_id.string' => 'Le champ stripe_session_id doit être une chaîne de caractères',
            'reference.string' => 'Le champ reference doit être une chaîne de caractères',
        ];
    }
}
