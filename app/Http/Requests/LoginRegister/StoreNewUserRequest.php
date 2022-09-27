<?php

namespace App\Http\Requests\LoginRegister;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewUserRequest extends FormRequest
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
    public function rules()
    {
        return [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'experience' => 'required_if:type,developer|max:80',
            'description' => 'required_if:type,developer|max:500'
        ];
    }
}
