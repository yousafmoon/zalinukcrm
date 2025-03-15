<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge([
            'id' => $this->id,
            'choice_of_country' => $this->choice_of_country,
            'intake' => $this->intake,
            'intended_course' => $this->intended_course,
            'firstname' => $this->firstname,
            'middlename' => $this->middlename,
            'surname' => $this->surname,
            'nickname' => $this->nickname,
            'email' => $this->email,
            'gender' => $this->gender,
            'nationality' => $this->nationality,
            'date_of_birth' => $this->date_of_birth,
            'place_of_birth' => $this->place_of_birth,
            'national_insurance' => $this->national_insurance,
            'other_nationalities' => $this->other_nationalities,
            'marital_status' => $this->marital_status,
            'criminal_conviction' => $this->criminal_conviction,
            'police_clearance' => $this->police_clearance,
            'disability' => $this->disability,
            'fircopy' => $this->fircopy,
            'living_situation' => $this->living_situation,
            'correspondence_address' => $this->correspondence_address,
            'FinancialDetails' => [
                'own_property' => $this->own_property,
                'bank_savings' => $this->bank_savings,
                'tuition_budget' => $this->tuition_budget,
                'bank_funds' => $this->bank_funds,
                'tuition_payer' => $this->tuition_payer,
            ],
            'StudentEmployment' => [
                'personal_circumstances' => $this->personal_circumstances,
                'employment_details' => $this->employment_details,
                'present_work' => $this->present_work,
                'company_name' => $this->company_name,
                'job_start_date' => $this->job_start_date,
                'work_address' => $this->work_address,
                'employer_phone' => $this->employer_phone,
                'employer_email' => $this->employer_email,
                'additional_jobs' => $this->additional_jobs,
            ],
            'IncomeDetails' => [
                'monthly_income' => $this->monthly_income,
                'income_from_others' => $this->income_from_others,
                'other_income_sources' => $this->other_income_sources,
                'monthly_income_given_to_family' => $this->monthly_income_given_to_family,
                'monthly_living_costs' => $this->monthly_living_costs,
            ],
            'References' => $this->References->map(function ($reference) {
                return [
                    'id' => $reference->id,
                    'name' => $reference->name,
                    'phone' => $reference->phone,
                    'email' => $reference->email,
                    'position' => $reference->position,
                    'relationship' => $reference->relationship,
                    'duration' => $reference->duration,
                ];
            }),

            'FinancialDocuments' => array_map(function ($document) {
                    return [
                        'document_title' => $document->document_title,
                        'document_name' => $document->document_name,
                        'document_path' => $document->document_path,
                    ];
                }),
            
            'PassportDetails' => [
                'passport_number' => $this->passport_number,
                'place_of_issue' => $this->place_of_issue,
                'issuing_authority' => $this->issuing_authority,
                'date_of_issue' => $this->date_of_issue,
                'date_of_expiry' => $this->date_of_expiry,
            ],
            'FirstPassportDetails' => [
                'previous_ppt_number' => $this->previous_ppt_number,
                'place_of_issue_previous' => $this->place_of_issue_previous,
                'issuing_authority_previous' => $this->issuing_authority_previous,
                'date_of_issue_previous' => $this->date_of_issue_previous,
                'date_of_expiry_previous' => $this->date_of_expiry_previous,
                'national_id_number' => $this->national_id_number,
            ],
            'ContactDetails' => [
                'address' => $this->address,
                'postal_code' => $this->postal_code,
                'how_long_lived' => $this->how_long_lived,
                'home_number' => $this->home_number,
                'mobile_number' => $this->mobile_number,
                'email_address' => $this->email_address,
                'contact_during_application' => $this->contact_during_application,
                'main_address_uk' => $this->main_address_uk,
                'ownership_status' => $this->ownership_status,
            ],
            'ParentsDetails' => [
                'father' => [
                    'given_name' => $this->father_given_name,
                    'family_name' => $this->father_family_name,
                    'date_of_birth' => $this->father_date_of_birth,
                    'place_of_birth' => $this->father_place_birth,
                    'nationality' => $this->father_nationality,
                ],
                'mother' => [
                    'given_name' => $this->mother_given_name,
                    'family_name' => $this->mother_family_name,
                    'date_of_birth' => $this->mother_date_of_birth,
                    'place_of_birth' => $this->mother_place_birth,
                    'nationality' => $this->mother_nationality,
                ]
            ],
            
            'TravelDetails' => [
                'travel_date' => $this->travel_date,
            ],

            'OtherInformationDetails' => [
                'family_in_uk' => $this->family_in_uk,
                'travelling_with_others' => $this->travelling_with_others,
            ],


            'QualificationsDetails' => [
                'qualifications' => $this->qualifications,
                'study_institution' => $this->study_institution,
                'subjects_studied' => $this->subjects_studied,
                'date_passed' => $this->date_passed,
                'study_gap_after_last_degree' => $this->study_gap_after_last_degree,
                'can_you_justify_gap' => $this->can_you_justify_gap,
            ],

            'ImmigrationDetails' => [
                'travel_outside' => $this->travel_outside,
                'travel_uk' => $this->travel_uk,
                'refused_uk_visa' => $this->refused_uk_visa,
                'refused_any_visa' => $this->refused_any_visa,
                'granted_uk_visa' => $this->granted_uk_visa,
                'refused_entry_uk' => $this->refused_entry_uk,
                'deported_uk' => $this->deported_uk,
                'deported_other_country' => $this->deported_other_country,
                'applied_home_office' => $this->applied_home_office,
                'breach_immigration_conditions' => $this->breach_immigration_conditions,
                'criminal_convictions' => $this->criminal_convictions,
                'charged_criminal_offence' => $this->charged_criminal_offence,
                'involved_in_war_crimes' => $this->involved_in_war_crimes,
                'involved_in_terrorism' => $this->involved_in_terrorism,
                'activities_bad_character' => $this->activities_bad_character,
                'nhs_treatment_unpaid' => $this->nhs_treatment_unpaid,
                'organization_type' => $this->organization_type,
            ],

            'UkVisaHistoryDetails' => [
                'visa_type' => $this->visa_type,
                'visa_valid_from' => $this->visa_valid_from,
                'visa_expiry_date' => $this->visa_expiry_date,
                'visa_reference_number' => $this->visa_reference_number,
            ],

            'OverseasTravelHistoryDetails' => [
                'uk_country_visited' => $this->uk_country_visited,
                'uk_date_arrived' => $this->uk_date_arrived,
                'uk_purpose_of_visit' => $this->uk_purpose_of_visit,
                'uk_length_of_stay' => $this->uk_length_of_stay,
                'europe_country_visited' => $this->europe_country_visited,
                'europe_date_arrived' => $this->europe_date_arrived,
                'europe_purpose_of_visit' => $this->europe_purpose_of_visit,
                'europe_length_of_stay' => $this->europe_length_of_stay,
                'acnz_usa_country_visited' => $this->acnz_usa_country_visited,
                'acnz_usa_date_arrived' => $this->acnz_usa_date_arrived,
                'acnz_usa_purpose_of_visit' => $this->acnz_usa_purpose_of_visit,
                'acnz_usa_length_of_stay' => $this->acnz_usa_length_of_stay,
                'row_country_visited' => $this->row_country_visited,
                'row_date_arrived' => $this->row_date_arrived,
                'row_purpose_of_visit' => $this->row_purpose_of_visit,
                'row_length_of_stay' => $this->row_length_of_stay,
            ],

             'SpouseParnersNotAccompanyingDetails' => [
                'spouse_given_name' => $this->spouse_given_name,
                'spouse_family_name' => $this->spouse_family_name,
                'spouse_passport_number' => $this->spouse_passport_number,
                'spouse_location' => $this->spouse_location,
                'spouse_dob' => $this->spouse_dob,
                'spouse_nationality' => $this->spouse_nationality,
                'spouse_accompanying_uk' => $this->spouse_accompanying_uk,
            ],

            'Children' => $this->Children->map(function ($child) {
                return [
                    'id' => $child->id,
                    'full_name' => $child->full_name,
                    'gender' => $child->gender,
                    'dob' => $child->dob,
                    'place_of_birth' => $child->place_of_birth,
                    'nationality' => $child->nationality,
                    'accompanying_uk' => $child->accompanying_uk,
                    'current_address' => $child->current_address,
                    'passport_number' => $child->passport_number,
                ];
            }),

            'SpouseParnersAccompanyingDetails' => [
                'spouse_father_given_name' => $this->spouse_father_given_name,
                'spouse_father_family_name' => $this->spouse_father_family_name,
                'father_dob' => $this->father_dob,
                'father_place_of_birth' => $this->father_place_of_birth,
                'spouse_mother_given_name' => $this->spouse_mother_given_name,
                'spouse_mother_family_name' => $this->spouse_mother_family_name,
                'mother_dob' => $this->mother_dob,
                'mother_place_of_birth' => $this->mother_place_of_birth,
                'spouse_visa_valid_from' => $this->spouse_visa_valid_from,
                'spouse_visa_expiry_date' => $this->spouse_visa_expiry_date,
                'spouse_visa_type' => $this->spouse_visa_type,
                'spouse_travel_history' => $this->spouse_travel_history,
            ],

            
            'RequirmentsForEuropeDetails' => [
                'do_you_have_block_account' => $this->do_you_have_block_account,
                'have_you_legalised_documents' => $this->have_you_legalised_documents,
                'bonafide_student_undertaking' => $this->bonafide_student_undertaking,
            ],

           'DocumentRequired' => $this->DocumentRequired->map(function ($document) {
                return [
                    'file_title' => $document->file_title,
                    'file_name' => $document->file_name,
                    'file_path' => $document->file_path,
                ];
            }),


            'CheckCopyDetails' => [
                'copy_current_passport' => $this->copy_current_passport,
                'copy_any_current_previous_uk_visas' => $this->copy_any_current_previous_uk_visas,
                'copy_any_previous_passports' => $this->copy_any_previous_passports,
                'remarks' => $this->remarks,
            ],
        ])
    }
}