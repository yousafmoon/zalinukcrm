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
            'choice_of_country' => 'nullable|string',
            'intake' => 'nullable|date',
            'intended_course'=>'nullable|string',
            'firstname' => 'nullable|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'surname' => 'nullable|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:students,email',
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

                   // Financial details (nested array)
            'financialDetails' => 'sometimes|array',
            'financialDetails.own_property' => 'nullable|string|max:255',
            'financialDetails.bank_savings' => 'nullable|string|max:255',
            'financialDetails.tuition_budget' => 'nullable|numeric',
            'financialDetails.bank_funds' => 'nullable|string|max:255',
            'financialDetails.tuition_payer' => 'nullable|string|max:255',

            // Student Employment (nested array)
            'StudentEmployment' => 'sometimes|array',
            'StudentEmployment.*.personal_circumstances' => 'nullable|string|max:255',
            'StudentEmployment.*.employment_details' => 'nullable|string|max:255',
            'StudentEmployment.*.present_work' => 'nullable|string|max:255',
            'StudentEmployment.*.company_name' => 'nullable|string|max:255',
            'StudentEmployment.*.job_start_date' => 'nullable|date',
            'StudentEmployment.*.work_address' => 'nullable|string|max:255',
            'StudentEmployment.*.employer_phone' => 'nullable|numeric|digits_between:8,20',
            'StudentEmployment.*.employer_email' => 'nullable|email|max:255',
            'StudentEmployment.*.additional_jobs' => 'nullable|string|max:255',

            // Income details (nested array)
            'incomeDetails' => 'nullable|array',
            'incomeDetails.monthly_income' => 'nullable|numeric',
            'incomeDetails.income_from_others' => 'nullable|string|max:255',
            'incomeDetails.other_income_sources' => 'nullable|string|max:255',
            'incomeDetails.monthly_income_given_to_family' => 'nullable|numeric',
            'incomeDetails.monthly_living_costs' => 'nullable|numeric',

                // studentReferences (nested array)
                'studentReferences' => 'nullable|array',
                'studentReferences.*.name' => 'nullable|string|max:255',
                'studentReferences.*.phone' => 'nullable|string|max:20',
                'studentReferences.*.email' => 'nullable|email|max:255',
                'studentReferences.*.position' => 'nullable|string|max:255',
                'studentReferences.*.relationship' => 'nullable|string|max:255',
                'studentReferences.*.duration' => 'nullable|string|max:255',

                // Financial documents (nested array)
                'FinancialDocuments' => 'nullable|array',
                'FinancialDocuments.*.document_title' => 'nullable|string|max:255',
                'FinancialDocuments.*.document_name' => 'nullable|string|max:255',
                'FinancialDocuments.*.document_path' => 'nullable|string|max:255',

                // Passport details (nested array)
                'passportDetails' => 'nullable|array',
                'passportDetails.passport_number' => 'nullable|string|max:255',
                'passportDetails.place_of_issue' => 'nullable|string|max:255',
                'passportDetails.issuing_authority' => 'nullable|string|max:255',
                'passportDetails.date_of_issue' => 'nullable|date',
                'passportDetails.date_of_expiry' => 'nullable|date',

                // First Passport Details (nested array)
                'firstpassportDetails' => 'nullable|array',
                'firstpassportDetails.previous_ppt_number' => 'nullable|string|max:255',
                'firstpassportDetails.place_of_issue_previous' => 'nullable|string|max:255',
                'firstpassportDetails.issuing_authority_previous' => 'nullable|string|max:255',
                'firstpassportDetails.date_of_issue_previous' => 'nullable|date',
                'firstpassportDetails.date_of_expiry_previous' => 'nullable|date',
                'firstpassportDetails.national_id_number' => 'nullable|string|max:255',

                // Contact details (nested array)
                'contactDetails' => 'nullable|array',
                'contactDetails.address' => 'nullable|string|max:255',
                'contactDetails.postal_code' => 'nullable|string|max:20',
                'contactDetails.how_long_lived' => 'nullable|string|max:255',
                'contactDetails.home_number' => 'nullable|string|max:20',
                'contactDetails.mobile_number' => 'nullable|string|max:20',
                'contactDetails.email_address' => 'nullable|email|max:255',
                'contactDetails.contact_during_application' => 'nullable|string|max:255',
                'contactDetails.main_address_uk' => 'nullable|string|max:255',
                'contactDetails.ownership_status' => 'nullable|string|max:255',

                // Parents details
                'parentsDetails' => 'nullable|array',
                'parentsDetails.father_given_name' => 'nullable|string|max:255',
                'parentsDetails.father_family_name' => 'nullable|string|max:255',
                'parentsDetails.father_date_of_birth' => 'nullable|date',
                'parentsDetails.father_place_birth' => 'nullable|string|max:255',
                'parentsDetails.father_nationality' => 'nullable|string|max:255',
                'parentsDetails.mother_given_name' => 'nullable|string|max:255',
                'parentsDetails.mother_family_name' => 'nullable|string|max:255',
                'parentsDetails.mother_date_of_birth' => 'nullable|date',
                'parentsDetails.mother_place_birth' => 'nullable|string|max:255',
                'parentsDetails.mother_nationality' => 'nullable|string|max:255',

                // Travel details (nested array)
                'travelDetails' => 'nullable|array',
                'travelDetails.travel_date' => 'nullable|date',

                // Other information details (nested array)
                'otherinformationDetails' => 'nullable|array',
                'otherinformationDetails.family_in_uk' => 'nullable|string|max:255',
                'otherinformationDetails.travelling_with_others' => 'nullable|string|max:255',

                // Qualifications details (nested array)
                'qualificationsDetails' => 'nullable|array',
                'qualificationsDetails.qualifications' => 'nullable|string|max:255',
                'qualificationsDetails.study_institution' => 'nullable|string|max:255',
                'qualificationsDetails.subjects_studied' => 'nullable|string|max:255',
                'qualificationsDetails.date_passed' => 'nullable|date',
                'qualificationsDetails.study_gap_after_last_degree' => 'nullable|string|max:255',
                'qualificationsDetails.can_you_justify_gap' => 'nullable|string|max:255',

                // Immigration details (nested array)
                'immigrationDetails' => 'nullable|array',
                'immigrationDetails.travel_outside' => 'nullable|string|max:255',
                'immigrationDetails.travel_uk' => 'nullable|string|max:255',
                'immigrationDetails.refused_uk_visa' => 'nullable|string|max:255',
                'immigrationDetails.refused_any_visa' => 'nullable|string|max:255',
                'immigrationDetails.granted_uk_visa' => 'nullable|string|max:255',
                'immigrationDetails.refused_entry_uk' => 'nullable|string|max:255',
                'immigrationDetails.deported_uk' => 'nullable|string|max:255',
                'immigrationDetails.deported_other_country' => 'nullable|string|max:255',
                'immigrationDetails.applied_home_office' => 'nullable|string|max:255',
                'immigrationDetails.breach_immigration_conditions' => 'nullable|string|max:255',
                'immigrationDetails.criminal_convictions' => 'nullable|string|max:255',
                'immigrationDetails.charged_criminal_offence' => 'nullable|string|max:255',
                'immigrationDetails.involved_in_war_crimes' => 'nullable|string|max:255',
                'immigrationDetails.involved_in_terrorism' => 'nullable|string|max:255',
                'immigrationDetails.activities_bad_character' => 'nullable|string|max:255',
                'immigrationDetails.nhs_treatment_unpaid' => 'nullable|string|max:255',
                'immigrationDetails.organization_type' => 'nullable|string|max:255',

                // UK Visa History details (nested array)
                'ukvisahistoryDetails' => 'nullable|array',
                'ukvisahistoryDetails.visa_type' => 'nullable|string|max:255',
                'ukvisahistoryDetails.visa_valid_from' => 'nullable|date',
                'ukvisahistoryDetails.visa_expiry_date' => 'nullable|date',
                'ukvisahistoryDetails.visa_reference_number' => 'nullable|string|max:255',

               'overseastravelhistoryDetails' => 'nullable|array',
                'overseastravelhistoryDetails.*.region_title' => 'nullable|string|max:255',
                'overseastravelhistoryDetails.*.visits' => 'nullable|array',
                'overseastravelhistoryDetails.*.visits.*.country_visited' => 'nullable|string|max:255',
                'overseastravelhistoryDetails.*.visits.*.date_arrived' => 'nullable|date',
                'overseastravelhistoryDetails.*.visits.*.purpose_of_visit' => 'nullable|string|max:255',
                'overseastravelhistoryDetails.*.visits.*.length_of_stay' => 'nullable|string|max:255',

                 // spouseparnersaccompanyingDetails
                'spouseparnersaccompanyingDetails' => 'nullable|array',
                'spouseparnersaccompanyingDetails.spouse_father_given_name' => 'nullable|string|max:255',
                'spouseparnersaccompanyingDetails.spouse_father_family_name' => 'nullable|string|max:255',
                'spouseparnersaccompanyingDetails.father_dob' => 'nullable|date',
                'spouseparnersaccompanyingDetails.father_place_of_birth' => 'nullable|string|max:255',
                
                'spouseparnersaccompanyingDetails.spouse_mother_given_name' => 'nullable|string|max:255',
                'spouseparnersaccompanyingDetails.spouse_mother_family_name' => 'nullable|string|max:255',
                'spouseparnersaccompanyingDetails.mother_dob' => 'nullable|date',
                'spouseparnersaccompanyingDetails.spouse_mother_place_of_birth' => 'nullable|string|max:255',
                
                'spouseparnersaccompanyingDetails.spouse_visa_valid_from' => 'nullable|date',
                'spouseparnersaccompanyingDetails.spouse_visa_expiry_date' => 'nullable|date',
                'spouseparnersaccompanyingDetails.spouse_visa_type' => 'nullable|string|max:255',
                'spouseparnersaccompanyingDetails.spouse_travel_history' => 'nullable|string|max:255',

                // childrendDetails
                'childrendDetails.*.id' => 'nullable|integer',
                'childrendDetails.*.child_full_name' => 'nullable|string|max:255',
                'childrendDetails.*.child_gender' => 'nullable|string|max:255',
                'childrendDetails.*.child_dob' => 'nullable|date',
                'childrendDetails.*.child_place_of_birth' => 'nullable|string|max:255',
                'childrendDetails.*.child_nationality' => 'nullable|string|max:255',
                'childrendDetails.*.child_accompanying_uk' => 'nullable|string',
                'childrendDetails.*.child_current_address' => 'nullable|string|max:255',
                'childrendDetails.*.child_passport_number' => 'nullable|string|max:255',

                            // SpousePartnersNotAccompanyingDetails
                'spousepartnersnotaccompanyingDetails' => 'nullable|array',
                'spousepartnersnotaccompanyingDetails.spouse_given_name' => 'nullable|string|max:255',
                'spousepartnersnotaccompanyingDetails.spouse_family_name' => 'nullable|string|max:255',
                'spousepartnersnotaccompanyingDetails.spouse_passport_number' => 'nullable|string|max:255',
                'spousepartnersnotaccompanyingDetails.spouse_location' => 'nullable|string|max:255',
                'spousepartnersnotaccompanyingDetails.spouse_dob' => 'nullable|date',
                'spousepartnersnotaccompanyingDetails.spouse_nationality' => 'nullable|string|max:255',
                'spousepartnersnotaccompanyingDetails.spouse_accompanying_uk' => 'nullable|boolean',


               
                // requirmentsforeuropeDetails
                'requirmentsforeuropeDetails.do_you_have_block_account' => 'nullable|string',
                'requirmentsforeuropeDetails.have_you_legalised_documents' => 'nullable|string',
                'requirmentsforeuropeDetails.bonafide_student_undertaking' => 'nullable|string',

                // DocumentsRequired
                'DocumentsRequired.*.file_title' => 'nullable|string|max:255',
                'DocumentsRequired.*.file_name' => 'nullable|string|max:255',
                'DocumentsRequired.*.file_path' => 'nullable|string|max:255',

                // CheckCopyDetails
                'CheckCopyDetails.copy_current_passport' => 'nullable|boolean',
                'CheckCopyDetails.copy_any_current_previous_uk_visas' => 'nullable|boolean',
                'CheckCopyDetails.copy_any_previous_passports' => 'nullable|boolean',
                'CheckCopyDetails.remarks' => 'nullable|string|max:1000',
         ];
        
    }
    public function messages()
    {
        return [
            'required' => 'This field is required.',
            'email' => 'Please enter a valid email address.',
        ];
    }
}

