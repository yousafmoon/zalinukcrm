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
                'fircopy' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'living_situation' => 'nullable|string|max:255',
                'correspondence_address' => 'nullable|string|max:255',

                // Financial details (nested array)
                'own_property' => 'nullable|string|max:255',
                'bank_savings' => 'nullable|string|max:255',
                'tuition_budget' => 'nullable|numeric',
                'bank_funds' => 'nullable|string|max:255',
                'tuition_payer' => 'nullable|string|max:255',

                // Student Employment (nested array)
                'StudentEmployment' => 'nullable|array',
                'StudentEmployment.*.personal_circumstances' => 'nullable|string|max:255',
                'StudentEmployment.*.employment_details' => 'nullable|string|max:255',
                'StudentEmployment.*.present_work' => 'nullable|string|max:255',
                'StudentEmployment.*.company_name' => 'nullable|string|max:255',
                'StudentEmployment.*.job_start_date' => 'nullable|date',
                'StudentEmployment.*.work_address' => 'nullable|string|max:255',
                'StudentEmployment.*.employer_phone' => 'nullable|string|max:20',
                'StudentEmployment.*.employer_email' => 'nullable|email|max:255',
                'StudentEmployment.*.additional_jobs' => 'nullable|string|max:255',

                // Income details (nested array)
                'IncomeDetails' => 'nullable|array',
                'IncomeDetails.monthly_income' => 'nullable|numeric',
                'IncomeDetails.income_from_others' => 'nullable|string|max:255',
                'IncomeDetails.other_income_sources' => 'nullable|string|max:255',
                'IncomeDetails.monthly_income_given_to_family' => 'nullable|numeric',
                'IncomeDetails.monthly_living_costs' => 'nullable|numeric',

                // References (nested array)
                'References' => 'nullable|array',
                'References.*.name' => 'nullable|string|max:255',
                'References.*.phone' => 'nullable|string|max:20',
                'References.*.email' => 'nullable|email|max:255',
                'References.*.position' => 'nullable|string|max:255',
                'References.*.relationship' => 'nullable|string|max:255',
                'References.*.duration' => 'nullable|string|max:255',

                // Financial documents (nested array)
                'FinancialDocuments' => 'nullable|array',
                'FinancialDocuments.*.document_title' => 'nullable|string|max:255',
                'FinancialDocuments.*.document_name' => 'nullable|string|max:255',
                'FinancialDocuments.*.document_path' => 'nullable|string|max:255',

                // Passport details (nested array)
                'PassportDetails' => 'nullable|array',
                'PassportDetails.passport_number' => 'nullable|string|max:255',
                'PassportDetails.place_of_issue' => 'nullable|string|max:255',
                'PassportDetails.issuing_authority' => 'nullable|string|max:255',
                'PassportDetails.date_of_issue' => 'nullable|date',
                'PassportDetails.date_of_expiry' => 'nullable|date',

                // First Passport Details (nested array)
                'FirstPassportDetails' => 'nullable|array',
                'FirstPassportDetails.previous_ppt_number' => 'nullable|string|max:255',
                'FirstPassportDetails.place_of_issue_previous' => 'nullable|string|max:255',
                'FirstPassportDetails.issuing_authority_previous' => 'nullable|string|max:255',
                'FirstPassportDetails.date_of_issue_previous' => 'nullable|date',
                'FirstPassportDetails.date_of_expiry_previous' => 'nullable|date',
                'FirstPassportDetails.national_id_number' => 'nullable|string|max:255',

                // Contact details (nested array)
                'ContactDetails' => 'nullable|array',
                'ContactDetails.address' => 'nullable|string|max:255',
                'ContactDetails.postal_code' => 'nullable|string|max:20',
                'ContactDetails.how_long_lived' => 'nullable|string|max:255',
                'ContactDetails.home_number' => 'nullable|string|max:20',
                'ContactDetails.mobile_number' => 'nullable|string|max:20',
                'ContactDetails.email_address' => 'nullable|email|max:255',
                'ContactDetails.contact_during_application' => 'nullable|string|max:255',
                'ContactDetails.main_address_uk' => 'nullable|string|max:255',
                'ContactDetails.ownership_status' => 'nullable|string|max:255',

                // Parents details (nested array)
                'ParentsDetails' => 'nullable|array',
                'ParentsDetails.father.given_name' => 'nullable|string|max:255',
                'ParentsDetails.father.family_name' => 'nullable|string|max:255',
                'ParentsDetails.father.date_of_birth' => 'nullable|date',
                'ParentsDetails.father.place_of_birth' => 'nullable|string|max:255',
                'ParentsDetails.father.nationality' => 'nullable|string|max:255',
                'ParentsDetails.mother.given_name' => 'nullable|string|max:255',
                'ParentsDetails.mother.family_name' => 'nullable|string|max:255',
                'ParentsDetails.mother.date_of_birth' => 'nullable|date',
                'ParentsDetails.mother.place_of_birth' => 'nullable|string|max:255',
                'ParentsDetails.mother.nationality' => 'nullable|string|max:255',

                // Travel details (nested array)
                'TravelDetails' => 'nullable|array',
                'TravelDetails.travel_date' => 'nullable|date',

                // Other information details (nested array)
                'OtherInformationDetails' => 'nullable|array',
                'OtherInformationDetails.family_in_uk' => 'nullable|string|max:255',
                'OtherInformationDetails.travelling_with_others' => 'nullable|string|max:255',

                // Qualifications details (nested array)
                'QualificationsDetails' => 'nullable|array',
                'QualificationsDetails.qualifications' => 'nullable|string|max:255',
                'QualificationsDetails.study_institution' => 'nullable|string|max:255',
                'QualificationsDetails.subjects_studied' => 'nullable|string|max:255',
                'QualificationsDetails.date_passed' => 'nullable|date',
                'QualificationsDetails.study_gap_after_last_degree' => 'nullable|string|max:255',
                'QualificationsDetails.can_you_justify_gap' => 'nullable|string|max:255',

                // Immigration details (nested array)
                'ImmigrationDetails' => 'nullable|array',
                'ImmigrationDetails.travel_outside' => 'nullable|string|max:255',
                'ImmigrationDetails.travel_uk' => 'nullable|string|max:255',
                'ImmigrationDetails.refused_uk_visa' => 'nullable|string|max:255',
                'ImmigrationDetails.refused_any_visa' => 'nullable|string|max:255',
                'ImmigrationDetails.granted_uk_visa' => 'nullable|string|max:255',
                'ImmigrationDetails.refused_entry_uk' => 'nullable|string|max:255',
                'ImmigrationDetails.deported_uk' => 'nullable|string|max:255',
                'ImmigrationDetails.deported_other_country' => 'nullable|string|max:255',
                'ImmigrationDetails.applied_home_office' => 'nullable|string|max:255',
                'ImmigrationDetails.breach_immigration_conditions' => 'nullable|string|max:255',
                'ImmigrationDetails.criminal_convictions' => 'nullable|string|max:255',
                'ImmigrationDetails.charged_criminal_offence' => 'nullable|string|max:255',
                'ImmigrationDetails.involved_in_war_crimes' => 'nullable|string|max:255',
                'ImmigrationDetails.involved_in_terrorism' => 'nullable|string|max:255',
                'ImmigrationDetails.activities_bad_character' => 'nullable|string|max:255',
                'ImmigrationDetails.nhs_treatment_unpaid' => 'nullable|string|max:255',
                'ImmigrationDetails.organization_type' => 'nullable|string|max:255',

                // UK Visa History details (nested array)
                'UkVisaHistoryDetails' => 'nullable|array',
                'UkVisaHistoryDetails.visa_type' => 'nullable|string|max:255',
                'UkVisaHistoryDetails.visa_valid_from' => 'nullable|date',
                'UkVisaHistoryDetails.visa_expiry_date' => 'nullable|date',
                'UkVisaHistoryDetails.visa_reference_number' => 'nullable|string|max:255',

                    // OverseasTravelHistoryDetails
                'OverseasTravelHistoryDetails.uk_country_visited' => 'nullable|string|max:255',
                'OverseasTravelHistoryDetails.uk_date_arrived' => 'nullable|date',
                'OverseasTravelHistoryDetails.uk_purpose_of_visit' => 'nullable|string|max:255',
                'OverseasTravelHistoryDetails.uk_length_of_stay' => 'nullable|string|max:255',
                
                'OverseasTravelHistoryDetails.europe_country_visited' => 'nullable|string|max:255',
                'OverseasTravelHistoryDetails.europe_date_arrived' => 'nullable|date',
                'OverseasTravelHistoryDetails.europe_purpose_of_visit' => 'nullable|string|max:255',
                'OverseasTravelHistoryDetails.europe_length_of_stay' => 'nullable|string|max:255',
                
                'OverseasTravelHistoryDetails.acnz_usa_country_visited' => 'nullable|string|max:255',
                'OverseasTravelHistoryDetails.acnz_usa_date_arrived' => 'nullable|date',
                'OverseasTravelHistoryDetails.acnz_usa_purpose_of_visit' => 'nullable|string|max:255',
                'OverseasTravelHistoryDetails.acnz_usa_length_of_stay' => 'nullable|string|max:255',
                
                'OverseasTravelHistoryDetails.row_country_visited' => 'nullable|string|max:255',
                'OverseasTravelHistoryDetails.row_date_arrived' => 'nullable|date',
                'OverseasTravelHistoryDetails.row_purpose_of_visit' => 'nullable|string|max:255',
                'OverseasTravelHistoryDetails.row_length_of_stay' => 'nullable|string|max:255',

                // SpouseParnersNotAccompanyingDetails
                'SpouseParnersNotAccompanyingDetails.spouse_given_name' => 'nullable|string|max:255',
                'SpouseParnersNotAccompanyingDetails.spouse_family_name' => 'nullable|string|max:255',
                'SpouseParnersNotAccompanyingDetails.spouse_passport_number' => 'nullable|string|max:255',
                'SpouseParnersNotAccompanyingDetails.spouse_location' => 'nullable|string|max:255',
                'SpouseParnersNotAccompanyingDetails.spouse_dob' => 'nullable|date',
                'SpouseParnersNotAccompanyingDetails.spouse_nationality' => 'nullable|string|max:255',
                'SpouseParnersNotAccompanyingDetails.spouse_accompanying_uk' => 'nullable|boolean',

                // Childrens
                'Childrens.*.id' => 'nullable|integer',
                'Childrens.*.full_name' => 'nullable|string|max:255',
                'Childrens.*.gender' => 'nullable|string|max:255',
                'Childrens.*.dob' => 'nullable|date',
                'Childrens.*.place_of_birth' => 'nullable|string|max:255',
                'Childrens.*.nationality' => 'nullable|string|max:255',
                'Childrens.*.accompanying_uk' => 'nullable|boolean',
                'Childrens.*.current_address' => 'nullable|string|max:255',
                'Childrens.*.passport_number' => 'nullable|string|max:255',

                // SpouseParnersAccompanyingDetails
                'SpouseParnersAccompanyingDetails.spouse_father_given_name' => 'nullable|string|max:255',
                'SpouseParnersAccompanyingDetails.spouse_father_family_name' => 'nullable|string|max:255',
                'SpouseParnersAccompanyingDetails.father_dob' => 'nullable|date',
                'SpouseParnersAccompanyingDetails.father_place_of_birth' => 'nullable|string|max:255',
                
                'SpouseParnersAccompanyingDetails.spouse_mother_given_name' => 'nullable|string|max:255',
                'SpouseParnersAccompanyingDetails.spouse_mother_family_name' => 'nullable|string|max:255',
                'SpouseParnersAccompanyingDetails.mother_dob' => 'nullable|date',
                'SpouseParnersAccompanyingDetails.mother_place_of_birth' => 'nullable|string|max:255',
                
                'SpouseParnersAccompanyingDetails.spouse_visa_valid_from' => 'nullable|date',
                'SpouseParnersAccompanyingDetails.spouse_visa_expiry_date' => 'nullable|date',
                'SpouseParnersAccompanyingDetails.spouse_visa_type' => 'nullable|string|max:255',
                'SpouseParnersAccompanyingDetails.spouse_travel_history' => 'nullable|string|max:255',

                // RequirmentsForEuropeDetails
                'RequirmentsForEuropeDetails.do_you_have_block_account' => 'nullable|boolean',
                'RequirmentsForEuropeDetails.have_you_legalised_documents' => 'nullable|boolean',
                'RequirmentsForEuropeDetails.bonafide_student_undertaking' => 'nullable|boolean',

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

