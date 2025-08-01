<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return $user->has("role:admin");
        return true; // Assuming all users can create job categories for simplicity
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:companies,name',
            'location' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'website' => 'string|max:255',

            // owner data
            'ownerName' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:255',
        ];
    }

    /**
     * Get the custom messages for the validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The company name is required.',
            'name.string' => 'The company name must be a string.',
            'name.max' => 'The company name must not be greater than 255 characters.',
            'name.unique' => 'The company name must be unique.',
            'location.required' => 'The company location is required.',
            'location.string' => 'The company location must be a string.',
            'location.max' => 'The company location must not be greater than 255 characters.',
            'industry.required' => 'The company industry is required.',
            'industry.string' => 'The company industry must be a string.',
            'industry.max' => 'The company industry must not be greater than 255 characters.',
            'website.string' => 'The company website must be a string.',
            'website.max' => 'The company website must not be greater than 255 characters.',

            // owner msg
            'ownerName.required' => 'The company name is required.',
            'ownerName.string' => 'The company name must be a string.',
            'ownerName.max' => 'The company name must not be greater than 255 characters.',
            'email.required' => 'The company name is required.',
            'email.string' => 'The company name must be a string.',
            'email.max' => 'The company name must not be greater than 255 characters.',
            'email.unique' => 'The company name must be unique.',
            'password.required' => 'The company name is required.',
            'password.string' => 'The company name must be a string.',
            'password.max' => 'The company name must not be greater than 255 characters.',
            'password.min' => 'The company name must not be at least 8 characters.',
        ];
    }
}
