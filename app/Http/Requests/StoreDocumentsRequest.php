<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class StoreDocumentsRequest extends FormRequest
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
          
            'student_id' => 'required|exists:students,id',

            // required documents (nested array)
            'requiredDocuments' => 'nullable|array',
            'requiredDocuments.*.document_type' => 'required|string|max:255',
            'requiredDocuments.*.file_name' => 'nullable|string|max:255',
            'requiredDocuments.*.original_name' => 'nullable|string|max:255',
            'requiredDocuments.*.file_path' => 'nullable|string|max:255',
            'requiredDocuments.*.uploaded_at' => 'nullable|string|max:255',
            'requiredDocuments.*.file' => 'nullable|file|mimes:pdf,jpg,png',

         ];
        
    }
    public function messages()
    {
        return [
    
        'student_id.required' => 'Student ID is required to create a document.',
        'student_id.exists' => 'The selected student does not exist.',
        'required' => 'This field is required.',
        
    ];
    }
}

