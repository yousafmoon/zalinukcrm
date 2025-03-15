<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'choice_of_country' => 'required|string',
            'intake' => 'required|date',
            'intended_course' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'surname' => 'nullable|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:students,email',
            'gender' => 'nullable|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
        ];
        
    }
    public function messages()
    {
        return [
            'required' => 'This field is required.',
            'email' => 'Please enter a valid email address.',
            'boolean' => 'This field must be true or false.',
            'date' => 'Please enter a valid date.',
            'numeric' => 'Please enter a valid number.',
            'string' => 'This field must be a string.',
        ];
    }
}

