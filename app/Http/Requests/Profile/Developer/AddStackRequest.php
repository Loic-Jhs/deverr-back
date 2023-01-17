<?php

namespace App\Http\Requests\Profile\Developer;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class AddStackRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('isDeveloper');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'developer_id' => 'integer|exists:developers,id',
            'stack_id' => 'required|integer|exists:stacks,id',
            'stack_experience' => 'required|integer',
            'is_primary' => 'required|in:0,1',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'developer_id.integer' => 'Le développeur doit être un nombre',
            'developer_id.exists' => 'Le développeur n\'existe pas',
            'stack_id.required' => 'La stack est requise',
            'stack_id.integer' => 'La stack doit être un nombre',
            'stack_id.exists' => 'La stack n\'existe pas',
            'stack_experience.required' => 'L\'expérience est requise',
            'stack_experience.integer' => 'L\'expérience doit être un nombre',
            'is_primary.required' => 'La valeur de stack principale est requise',
            'is_primary.in' => 'La stack principale doit être 0 pour "non" ou 1 pour "oui"',
        ];
    }
}
