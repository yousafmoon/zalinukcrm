<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateDocumentsRequest extends FormRequest
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
                'student_id' => ['required', 'exists:students,id'],
                'document_id' => ['nullable', 'exists:documents,id'],
                'requiredDocuments' => ['nullable', 'array'],
                'requiredDocuments.*.document_type' => ['nullable', 'string'],
                'requiredDocuments.*.file' => ['nullable', 'file'],
                'requiredDocuments.*.id' => ['nullable', 'exists:required_documents,id'],
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
