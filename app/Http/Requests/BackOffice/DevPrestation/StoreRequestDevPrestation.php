<?php

namespace App\Http\Requests\Backoffice\DevPrestation;

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
            'developer_id' => 'required|int',
            'description' => 'required|string|max:255',
            'prestation_type_id' => 'required|int',
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

        ];
    }
}
