<?php

namespace App\Http\Requests\Backoffice\DevPrestation;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequestDevPrestation extends FormRequest
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

    public function rules(): array
    {
        return [
            'developer_id' => 'nullable|int',
            'description' => 'nullable|string|max:255',
            'prestation_type_id' => 'nullable|int',
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
        ];
    }
}
