<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'username' => ['required', 'string', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'password' => ['required', 'string', 'min:8'],
            'birthday' => ['nullable', 'date'],
            'bio' => ['nullable', 'string'],
            'is_admin' => ['required', 'boolean'],
        ];
    }
        
    public function messages(): array
    {
        return [
            'is_admin.required' => 'The is_admin field is required.',
        ];
    }
}
