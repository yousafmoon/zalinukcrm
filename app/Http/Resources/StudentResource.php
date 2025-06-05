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
            'financialDetails' => [
                'own_property' => $this->own_property,
                'bank_savings' => $this->bank_savings,
                'tuition_budget' => $this->tuition_budget,
                'bank_funds' => $this->bank_funds,
                'tuition_payer' => $this->tuition_payer,
            ],
            'studentEmployment' => [
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
            'incomeDetails' => [
                'monthly_income' => $this->monthly_income,
                'income_from_others' => $this->income_from_others,
                'other_income_sources' => $this->other_income_sources,
                'monthly_income_given_to_family' => $this->monthly_income_given_to_family,
                'monthly_living_costs' => $this->monthly_living_costs,
            ],
            'studentReferences' => $this->studentReferences->map(function ($reference) {
                return [
                    'id' => $reference->id,
                    'ref_name' => $reference->ref_name,
                    'ref_phone' => $reference->ref_phone,
                    'ref_email' => $reference->ref_email,
                    'ref_position' => $reference->ref_position,
                    'ref_relationship' => $reference->ref_relationship,
                    'ref_duration' => $reference->ref_duration,
                ];
            }),

        'financialDocuments' => array_map(function ($document) {
            return [
                'document_title' => $document->document_title,
                'document_name' => $document->document_name,
                'document_path' => $document->document_path,
                'file' => $document->file,
            ];
        }, $financialDocuments ?? []),

            
          'passportDetails' => $this->passportDetails ? [
            'passport_number' => $this->passportDetails->passport_number,
            'place_of_issue' => $this->passportDetails->place_of_issue,
            'issuing_authority' => $this->passportDetails->issuing_authority,
            'date_of_issue' => $this->passportDetails->date_of_issue,
            'date_of_expiry' => $this->passportDetails->date_of_expiry,
        ] : null,

            'firstpassportDetails' => [
                'previous_ppt_number' => $this->previous_ppt_number,
                'place_of_issue_previous' => $this->place_of_issue_previous,
                'issuing_authority_previous' => $this->issuing_authority_previous,
                'date_of_issue_previous' => $this->date_of_issue_previous,
                'date_of_expiry_previous' => $this->date_of_expiry_previous,
                'national_id_number' => $this->national_id_number,
            ],
            'contactDetails' => [
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
            'parentsDetails' => [
                    'father_given_name' => $this->father_given_name,
                    'father_family_name' => $this->father_family_name,
                    'father_date_of_birth' => $this->father_date_of_birth,
                    'father_place_birth' => $this->father_place_birth,
                    'father_nationality' => $this->father_nationality,
                    'mother_given_name' => $this->mother_given_name,
                    'mother_family_name' => $this->mother_family_name,
                    'mother_date_of_birth' => $this->mother_date_of_birth,
                    'mother_place_birth' => $this->mother_place_birth,
                    'mother_nationality' => $this->mother_nationality,
            ],
            
            'travelDetails' => [
                'travel_date' => $this->travel_date,
            ],

            'otherinformationDetails' => [
                'family_in_uk' => $this->family_in_uk,
                'travelling_with_others' => $this->travelling_with_others,
            ],


            'qualificationsDetails' => [
                'qualifications' => $this->qualifications,
                'study_institution' => $this->study_institution,
                'subjects_studied' => $this->subjects_studied,
                'date_passed' => $this->date_passed,
                'study_gap_after_last_degree' => $this->study_gap_after_last_degree,
                'can_you_justify_gap' => $this->can_you_justify_gap,
            ],

            'immigrationDetails' => [
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

            'ukvisahistoryDetails' => [
                'visa_type' => $this->visa_type,
                'visa_valid_from' => $this->visa_valid_from,
                'visa_expiry_date' => $this->visa_expiry_date,
                'visa_reference_number' => $this->visa_reference_number,
            ],

                'overseastravelhistoryDetails' => collect($this->overseastravelhistoryDetails)->map(function ($region) {
                return [
                    'region_title' => $region['region_title'],  
                    'visits' => collect($region['visits'])->map(function ($visit) {
                        return [
                            'country_visited' => $visit['country_visited'],
                            'date_arrived' => $visit['date_arrived'],
                            'purpose_of_visit' => $visit['purpose_of_visit'],
                            'length_of_stay' => $visit['length_of_stay'],
                        ];
                    })->toArray(),
                ];
            })->toArray(),


              'spouseparnersaccompanyingDetails' => [
                'spouse_father_given_name' => $this->spouse_father_given_name,
                'spouse_father_family_name' => $this->spouse_father_family_name,
                'father_dob' => $this->father_dob,
                'father_place_of_birth' => $this->father_place_of_birth,
                'spouse_mother_given_name' => $this->spouse_mother_given_name,
                'spouse_mother_family_name' => $this->spouse_mother_family_name,
                'mother_dob' => $this->mother_dob,
                'spouse_mother_place_of_birth' => $this->spouse_mother_place_of_birth,
                'spouse_visa_valid_from' => $this->spouse_visa_valid_from,
                'spouse_visa_expiry_date' => $this->spouse_visa_expiry_date,
                'spouse_visa_type' => $this->spouse_visa_type,
                'spouse_travel_history' => $this->spouse_travel_history,
            ],

        
            'childrenDetails' => $this->childrenDetails->map(function ($child) {
                return [
                    'id' => $child->id,
                    'child_full_name' => $child->child_full_name,
                    'child_gender' => $child->child_gender,
                    'child_dob' => $child->child_dob,
                    'child_place_of_birth' => $child->child_place_of_birth,
                    'child_child_nationality' => $child->child_nationality,
                    'child_accompanying_uk' => $child->child_accompanying_uk,
                    'child_current_address' => $child->child_current_address,
                    'child_passport_number' => $child->child_passport_number,
                ];
            }),

                 'spousepartnersnotaccompanyingDetails' => [
                'spouse_given_name' => $this->spouse_given_name,
                'spouse_family_name' => $this->spouse_family_name,
                'spouse_passport_number' => $this->spouse_passport_number,
                'spouse_location' => $this->spouse_location,
                'spouse_dob' => $this->spouse_dob,
                'spouse_nationality' => $this->spouse_nationality,
                'spouse_accompanying_uk' => $this->spouse_accompanying_uk,
            ],

          
            'requirmentsforeuropeDetails' => [
                'do_you_have_block_account' => $this->do_you_have_block_account,
                'have_you_legalised_documents' => $this->have_you_legalised_documents,
                'bonafide_student_undertaking' => $this->bonafide_student_undertaking,
            ],

        ]);
    }
}