<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateLeadRequest extends FormRequest
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
           'choice_of_country' => 'nullable|string',
            'intake' => 'nullable|date',
            'intended_course'=>'nullable|string',
            'firstname' => 'nullable|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'surname' => 'nullable|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'email' => [
                    'sometimes',
                    'email',
                    $this->student 
                        ? Rule::unique('students', 'email')->ignore($this->student->id)
                        : Rule::unique('students', 'email'),
                ],
             'gender' => 'nullable|string|max:10',
            'nationality' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'place_of_birth' => 'nullable|string|max:255',
            'national_insurance' => 'nullable|string|max:255',
            'other_nationalities' => 'nullable|string|max:255',
            'marital_status' => 'nullable|string|max:255',
            'criminal_conviction' => 'nullable|string|max:255',
            'police_clearance' => 'nullable|string|max:255',
            'disability' => 'nullable|string|max:255',
            'living_situation' => 'nullable|string|max:255',
            'correspondence_address' => 'nullable|string|max:255',
        ];
        
    }
    public function messages()
{
    return [
        'required' => 'This field is required.',
        'email' => 'Please enter a valid email address.',
        'max' => 'This field cannot be longer than :max characters.',
    ];
}

}
