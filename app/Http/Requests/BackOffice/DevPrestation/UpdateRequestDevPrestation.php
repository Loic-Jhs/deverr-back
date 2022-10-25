<?php

namespace App\Http\Requests\Backoffice\Prestation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateRequestDevPrestation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('isAdmin');
    }

    public function rules(): array
    {
        return [
            'developer_id' => 'required|int',
            'prestation_id' => 'required|int',
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
