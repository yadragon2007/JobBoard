<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobVacancyUpdateRequest extends FormRequest
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
            'title' => 'bail|required|string|max:255',
            'description' => 'bail|required|string|max:1000',
            'location' => 'bail|required|string|max:255',
            'salary' => 'bail|required|string|max:255',
            'employment_type' => 'bail|required|string|max:255',
            "company_id" => "bail|required|string|max:255|exists:companies,id",
            "job_category_id" => "bail|required|string|max:255|exists:job_categories,id",

        ];
    }

    /**
     * Get the custom messages for the validation rules.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'The job title is required.',
            'title.string' => 'The job title must be a string.',
            'title.max' => 'The job title may not be greater than 255 characters.',

            'description.required' => 'The job description is required.',
            'description.string' => 'The job description must be a string.',
            'description.max' => 'The job description may not be greater than 1000 characters.',

            'location.required' => 'The job location is required.',
            'location.string' => 'The job location must be a string.',
            'location.max' => 'The job location may not be greater than 255 characters.',

            'salary.required' => 'The salary is required.',
            'salary.string' => 'The salary must be a string.',
            'salary.max' => 'The salary may not be greater than 255 characters.',

            'company_id.required' => 'The company is required.',
            'company_id.string' => 'The company ID must be a string.',
            'company_id.max' => 'The company ID may not be greater than 255 characters.',
            'company_id.exists' => 'The selected company does not exist.',

            'job_category_id.required' => 'The job category is required.',
            'job_category_id.string' => 'The job category ID must be a string.',
            'job_category_id.max' => 'The job category ID may not be greater than 255 characters.',
            'job_category_id.exists' => 'The selected job category does not exist.',
        ];
    }
}
