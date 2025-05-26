<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use App\Services\StudentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class StudentController extends Controller
{
    protected $studentService;

        public function __construct(StudentService $studentService)
        {
             $this->studentService = $studentService;
            $this->middleware('can:viewAny,App\Models\Student');
        }

    public function index(Request $request)
    {
        $this->authorize('viewAny', Student::class);

        $students = $this->studentService->getStudents($request->search);

        return inertia('Students/Index', [
            'students' => StudentResource::collection($students),
            'search' => $request->search ?? '',
            'totalStudents' => $students->total(),
        ]);
    }

    public function show($id)
    {
        $student = $this->studentService->getStudentById($id);

        return inertia('Students/View', [
            'student' => $student,
        ]);
    }

    public function create()
    {
        $this->authorize('create', Student::class);
        return inertia('Students/Create');
    }

    public function store(StoreStudentRequest $request)
    {
        $this->authorize('create', Student::class);
        $student = $this->studentService->storeStudent($request);
        if (!$student || !$student->id) {
            return back()->with('error', 'Failed to create student.');
        }
        $financialDetails = $request->input('financialDetails');
        $studentEmployment = $request->input('studentEmployment');
        $incomeDetails = $request->input('incomeDetails');
        $studentReferences = $request->input('studentReferences');
        $passportDetails = $request->input('passportDetails');
        $firstpassportDetails = $request->input('firstpassportDetails');
        $contactDetails = $request->input('contactDetails');
        $parentsDetails = $request->input('parentsDetails');
        $travelDetails = $request->input('travelDetails');
        $otherinformationDetails = $request->input('otherinformationDetails');
        $qualificationsDetails = $request->input('qualificationsDetails');
        $immigrationDetails = $request->input('immigrationDetails');
        $ukvisahistoryDetails = $request->input('ukvisahistoryDetails');
        $overseastravelhistoryDetails = $request->input('overseastravelhistoryDetails');
        $spousepartnersaccompanyingDetails = $request->input('spousepartnersaccompanyingDetails');
        $childrenDetails = $request->input('childrenDetails'); 
        $familynotaccompanyingDetails = $request->input('familynotaccompanyingDetails'); 
        $requirementsforeuropeDetails = $request->input('requirementsforeuropeDetails'); 
        

        if (!empty($financialDetails)) {
            $this->studentService->storeFinancialDetails($financialDetails, $student);
        }

        if (!empty($studentEmployment)) {
            $this->studentService->storeStudentEmployment($studentEmployment, $student);
        }

         if (!empty($incomeDetails)) {
            $this->studentService->storeIncomeDetails($incomeDetails, $student);
        }

         if (!empty($studentReferences)) {
            $this->studentService->storestudentReferences($studentReferences, $student);
        }

          if (!empty($passportDetails)) {
            $this->studentService->storePassportDetails($passportDetails, $student);
        }
        if (!empty($firstpassportDetails)) {
            $this->studentService->storeFirstPassportDetails($firstpassportDetails, $student);
        }
        if (!empty($contactDetails)) {
            $this->studentService->storeContactDetails($contactDetails, $student);
        }
         if (!empty($parentsDetails)) {
            $this->studentService->storeParentsDetails($parentsDetails, $student);
        }
        if (!empty($travelDetails)) {
            $this->studentService->storeTravelDetails($travelDetails, $student);
        }
        if(!empty($otherinformationDetails)) {
            $this->studentService->storeOtherInformationDetails($otherinformationDetails, $student);
        }
        if(!empty($qualificationsDetails)) {
            $this->studentService->storeQualificationsDetails($qualificationsDetails, $student);
        }
        if(!empty($immigrationDetails)) {
            $this->studentService->storeImmigrationDetails($immigrationDetails, $student);
        }
        if(!empty($ukvisahistoryDetails)) {
            $this->studentService->storeUkVisaHistoryDetails($ukvisahistoryDetails, $student);
        }

         if (!empty($overseastravelhistoryDetails)) {
            $this->studentService->storeOverseasTravelHistoryDetails($overseastravelhistoryDetails, $student);
        }
        
         if(!empty($spousepartnersaccompanyingDetails)) {
            $this->studentService->storeSpousePartnersAccompanyingDetails($spousepartnersaccompanyingDetails, $student);
        }
        
          if (!empty($childrenDetails)) {
            $this->studentService->storechildrenDetails($childrenDetails, $student);
        }

         if(!empty($familynotaccompanyingDetails)) {
            $this->studentService->storeFamilyNotAccompanyingDetails($familynotaccompanyingDetails, $student);
        }

         if(!empty($requirementsforeuropeDetails)) {
            $this->studentService->storeRequirementsForEuropeDetails($requirementsforeuropeDetails, $student);
        }

        
    
        return redirect()->route('students.index')->with('message', 'Student created successfully.');
    }

    public function edit(Student $student)
    {
        $this->authorize('update', $student);
        $student->load(['financialDetails', 'studentEmployment', 'incomeDetails', 'studentReferences', 'passportDetails', 
        'firstpassportDetails', 'parentsDetails', 'travelDetails', 'otherinformationDetails', 'qualificationsDetails', 
        'immigrationDetails', 'ukvisahistoryDetails', 'overseastravelhistoryDetails', 'spousepartnersaccompanyingDetails', 'childrenDetails', 
        'familynotaccompanyingDetails','requirementsforeuropeDetails']);

        $financialDefaults = [
            'own_property'     => '',
            'bank_savings'     => '',
            'tuition_budget'   => '',
            'bank_funds'       => '',
            'tuition_payer'    => '',
        ];

        $financialData = $student->financialDetails
            ? array_merge($financialDefaults, $student->financialDetails->toArray())
            : $financialDefaults;

        $booleanFields = ['own_property', 'bank_savings'];
        foreach ($booleanFields as $field) {
            $value = strtolower(trim($financialData[$field] ?? ''));
            $financialData[$field] = ($value === 'yes') ? 'Yes' : 'No';
        }

        $employmentDefaults = [
            'personal_circumstances' => '',
            'employment_details'     => '',
            'present_work'           => '',
            'company_name'           => '',
            'job_start_date'         => '',
            'work_address'           => '',
            'employer_phone'         => '',
            'employer_email'         => '',
            'additional_jobs'        => '',
        ];

        $employmentData = [];

        if ($student->studentEmployment && $student->studentEmployment->count()) {
            foreach ($student->studentEmployment as $employment) {
                $employmentData[] = array_merge($employmentDefaults, $employment->toArray());
            }
        } else {
            $employmentData[] = $employmentDefaults;
        }

           $incomeDefaults = [
            'monthly_income'     => '',
            'income_from_others'     => '',
            'other_income_sources'   => '',
            'monthly_income_given_to_family' => '',
            'monthly_living_costs'    => '',
        ];

        $incomeData = $student->incomeDetails
            ? array_merge($incomeDefaults, $student->incomeDetails->toArray())
            : $incomeDefaults;

        $booleanFields = ['income_from_others', 'other_income_sources'];
        foreach ($booleanFields as $field) {
            $value = strtolower(trim($incomeData[$field] ?? ''));
            $incomeData[$field] = ($value === 'yes') ? 'Yes' : 'No';
        }

          $studentReferencesDefaults = [
            'name' => '',
            'phone'  => '',
            'email'  => '',
            'position' => '',
            'relationship' => '',
            'duration' => '',
        ];

        $referencesData = [];

        if ($student->studentReferences && $student->studentReferences->count()) {
            foreach ($student->studentReferences as $reference) {
                $referencesData[] = array_merge($studentReferencesDefaults, $reference->toArray());
            }
        } else {
            $referencesData[] = $studentReferencesDefaults;
        }

          $passportDetailsDefaults = [
            'passport_number'     => '',
            'place_of_issue'     => '',
            'issuing_authority'   => '',
            'date_of_issue' => '',
            'date_of_expiry'    => '',
        ];

        $passportData = $student->passportDetails
            ? array_merge($passportDetailsDefaults, $student->passportDetails->toArray())
            : $passportDetailsDefaults;
            
          $firstpassportDetailsDefaults = [
            'previous_ppt_number'     => '',
            'place_of_issue_previous'     => '',
            'issuing_authority_previous'   => '',
            'date_of_issue_previous' => '',
            'date_of_expiry_previous'    => '',
            'national_id_number'    => '',
        ];

        $firstpassportData = $student->firstpassportDetails
            ? array_merge($firstpassportDetailsDefaults, $student->firstpassportDetails->toArray())
            : $firstpassportDetailsDefaults;

           $contactDetailsDefaults = [
            'address'     => '',
            'postal_code'     => '',
            'how_long_lived'   => '',
            'home_number' => '',
            'mobile_number'    => '',
            'email_address'    => '',
            'contact_during_application'    => '',
            'main_address_uk'    => '',
            'ownership_status'    => '',

        ];

        $contactData = $student->contactDetails
            ? array_merge($contactDetailsDefaults, $student->contactDetails->toArray())
            : $contactDetailsDefaults;

        $booleanFields = ['contact_during_application'];
        foreach ($booleanFields as $field) {
            $value = strtolower(trim($contactData[$field] ?? ''));
            $contactData[$field] = ($value === 'yes') ? 'Yes' : 'No';
        }

          $parentsDetailsDefaults = [
            'father_given_name'     => '',
            'father_family_name'     => '',
            'father_date_of_birth'   => '',
            'father_place_of_birth' => '',
            'father_nationality'    => '',
             'mother_given_name'    => '',
             'mother_family_name'    => '',
             'mother_date_of_birth'    => '',
             'mother_place_of_birth'    => '',
             'mother_nationality'    => '',
        ];

        $parentsData = $student->parentsDetails
            ? array_merge($parentsDetailsDefaults, $student->parentsDetails->toArray())
            : $parentsDetailsDefaults;


              $travelDetailsDefaults = [
                    'travel_date'     => '',
                ];

        $travelData = $student->travelDetails
            ? array_merge($travelDetailsDefaults, $student->travelDetails->toArray())
            : $travelDetailsDefaults;

            $otherinformationDetailsDefaults = [
                'family_in_uk' => '',
                'travelling_with_others' => '',
            ];
          
             $otherinformationData = $student->otherinformationDetails
            ? array_merge($otherinformationDetailsDefaults, $student->otherinformationDetails->toArray())
            : $otherinformationDetailsDefaults;

            
        $booleanFields = ['family_in_uk', 'travelling_with_others'];
        foreach ($booleanFields as $field) {
            $value = strtolower(trim($otherinformationData[$field] ?? ''));
            $otherinformationData[$field] = ($value === 'yes') ? 'Yes' : 'No';
        }


         $qualificationsDetailsDefaults = [
                'family_in_uk' => '',
                'travelling_with_others' => '',
            ];
          
             $qualificationsData = $student->qualificationsDetails
            ? array_merge($qualificationsDetailsDefaults, $student->qualificationsDetails->toArray())
            : $qualificationsDetailsDefaults;

            
        $booleanFields = ['can_you_justify_gap'];
        foreach ($booleanFields as $field) {
            $value = strtolower(trim($qualificationsData[$field] ?? ''));
            $qualificationsData[$field] = ($value === 'yes') ? 'Yes' : 'No';
        }

         $immigrationDetailsDefaults = [
            'travel_outside'     => '',
            'travel_uk'     => '',
            'refused_uk_visa'   => '',
            'refused_entry_uk'       => '',
            'granted_uk_visa'    => '',
            'deported_uk'    => '',
            'deported_other_country'    => '',
            'applied_home_office'    => '',
            'breach_immigration_conditions'    => '',
            'criminal_convictions'    => '',
            'charged_criminal_offence'    => '',
            'involved_in_war_crimes'    => '',
            'involved_in_terrorism'    => '',
            'activities_bad_character'    => '',
            'nhs_treatment_unpaid'    => '',
             'organization_type'    => '',
        ];

        $immigrationData = $student->immigrationDetails
            ? array_merge($immigrationDetailsDefaults, $student->immigrationDetails->toArray())
            : $immigrationDetailsDefaults;

        $booleanFields = ['travel_outside', 'travel_uk', 'refused_uk_visa', 'refused_entry_uk', 'granted_uk_visa', 
        'deported_uk', 'deported_other_country', 'applied_home_office', 'breach_immigration_conditions', 
        'charged_criminal_offence', 'involved_in_war_crimes', 'involved_in_terrorism', 'nhs_treatment_unpaid'
     ];
        foreach ($booleanFields as $field) {
            $value = strtolower(trim($immigrationData[$field] ?? ''));
            $immigrationData[$field] = ($value === 'yes') ? 'Yes' : 'No';
        }

        $ukvisahistoryDetailsDefaults = [
            'visa_type'     => '',
            'visa_valid_from'     => '',
            'visa_expiry_date'   => '',
            'visa_reference_number'       => '',
        ];

        $ukvisahistoryData = $student->ukvisahistoryDetails
            ? array_merge($ukvisahistoryDetailsDefaults, $student->ukvisahistoryDetails->toArray())
            : $ukvisahistoryDetailsDefaults;

        $overseasTravelHistoryDefaults = [
                    'region_title' => '',
                    'student_id' => '',
                    'visits' => [] 
                ];

                $visitDefaults = [
                    'country_visited' => '',
                    'date_arrived' => '',
                    'purpose_of_visit' => '',
                    'length_of_stay' => '',
                ];

            $overseasTravelHistoryData = [];

            if ($student->overseastravelhistoryDetails && $student->overseastravelhistoryDetails->count()) {
                foreach ($student->overseastravelhistoryDetails as $region) {
                    $regionData = array_merge($overseasTravelHistoryDefaults, $region->toArray());
                    $visitsData = [];
                    if ($region->visits && $region->visits->count()) {
                        foreach ($region->visits as $visit) {
                            $visitsData[] = array_merge($visitDefaults, $visit->toArray());
                        }
                    } else {
                        $visitsData[] = $visitDefaults;
                    }
                    $regionData['visits'] = $visitsData;

                    $overseasTravelHistoryData[] = $regionData;
                }
            } else {
                $overseasTravelHistoryData[] = array_merge($overseasTravelHistoryDefaults, ['visits' => [$visitDefaults]]);
            }


        $spousepartnersaccompanyingDetailsDefaults = [
            'spouse_father_given_name'     => '',
            'spouse_father_family_name'     => '',
            'father_dob'   => '',
            'father_place_of_birth'       => '',
            'spouse_mother_given_name'       => '',
            'spouse_mother_family_name'       => '',
            'mother_dob'       => '',
            'spouse_mother_place_of_birth'       => '',
            'spouse_visa_valid_from'       => '',
            'spouse_visa_expiry_date'       => '',   
            'spouse_visa_type'       => '',  
            'spouse_travel_history'       => '',                                                                 
        ];

        $spousepartnersaccompanyingData = $student->spousepartnersaccompanyingDetails
            ? array_merge($spousepartnersaccompanyingDetailsDefaults, $student->spousepartnersaccompanyingDetails->toArray())
            : $spousepartnersaccompanyingDetailsDefaults;


        $childrenDetailsDefaults = [
                    'child_full_name' => '',
                    'child_gender'  => '',
                    'child_dob'  => '',
                    'child_place_of_birth' => '',
                    'child_nationality' => '',
                    'child_accompanying_uk' => '',
                    'child_current_address' => '',
                    'child_passport_number' => '',
                ];

         $childrenData = [];

            $booleanFields = ['child_accompanying_uk'];
            $lowercaseFields = ['child_gender']; 

            if ($student->childrenDetails && $student->childrenDetails->count()) {
                foreach ($student->childrenDetails as $child) {
                    $childArray = array_merge($childrenDetailsDefaults, $child->toArray());

                    foreach ($booleanFields as $field) {
                        $value = strtolower(trim($childArray[$field] ?? ''));
                        $childArray[$field] = ($value === 'yes') ? 'Yes' : 'No';
                    }

                    foreach ($lowercaseFields as $field) {
                        $childArray[$field] = strtolower(trim($childArray[$field] ?? ''));
                    }

                    $childrenData[] = $childArray;
                }
            } else {
                $childrenData[] = $childrenDetailsDefaults;
            }

             $familynotaccompanyingDetailsDefaults = [
                'spouse_given_name' => '',
                'spouse_family_name' => '',
                'spouse_passport_number' => '',
                'spouse_location' => '',
                'spouse_dob' => '',
                'spouse_nationality' => '',
                'spouse_accompanying_uk' => '',            
            ];
          
             $familynotaccompanyingData = $student->familynotaccompanyingDetails
            ? array_merge($familynotaccompanyingDetailsDefaults, $student->familynotaccompanyingDetails->toArray())
            : $familynotaccompanyingDetailsDefaults;

            
        $booleanFields = ['spouse_accompanying_uk'];
        foreach ($booleanFields as $field) {
            $value = strtolower(trim($familynotaccompanyingData[$field] ?? ''));
            $familynotaccompanyingData[$field] = ($value === 'yes') ? 'Yes' : 'No';
        }

        $requirementsforeuropeDetailsDefaults = [
            'do_you_have_block_account'     => '',
            'have_you_legalised_documents'     => '',
            'bonafide_student_undertaking'   => '',
        ];

        $requirementsforeuropeData = $student->requirementsforeuropeDetails
        ? array_merge($requirementsforeuropeDetailsDefaults, $student->requirementsforeuropeDetails->toArray())
        : $requirementsforeuropeDetailsDefaults;

        $studentData = $student->toArray();
        unset($studentData['financial_details'], $studentData['student_employment'], $studentData['income_details'], 
        $studentData['student_references'], $studentData['passport_details'], $studentData['first_passport_details'],
        $studentData['contact_details'], $studentData['parents_details'],$studentData['travel_details'], 
        $studentData['other_information_details'], $studentData['qualifications_details'], 
        $studentData['immigration_details'], $studentData['uk_visa_history_details'], 
        $studentData['overseas_travel_regions'],
        $studentData['spouse_partners_accompanying_details'],
        $studentData['children_details'],
        $studentData['spouse_partners_not_accompanying_details'], 
        $studentData['requirements_for_europe_details']
        );

        $studentData['financialDetails']  = $financialData;
        $studentData['studentEmployment'] = $employmentData;
        $studentData['incomeDetails'] = $incomeData;
        $studentData['studentReferences'] = $referencesData;
        $studentData['passportDetails'] = $passportData;
        $studentData['firstpassportDetails'] = $firstpassportData;
        $studentData['contactDetails'] = $contactData;
        $studentData['parentsDetails'] = $parentsData;
        $studentData['travelDetails'] = $travelData;
        $studentData['otherinformationDetails'] = $otherinformationData;
        $studentData['qualificationsDetails'] = $qualificationsData;
        $studentData['immigrationDetails'] = $immigrationData;
        $studentData['ukvisahistoryDetails'] = $ukvisahistoryData;
        $studentData['overseastravelhistoryDetails'] = $overseasTravelHistoryData;
        $studentData['spousepartnersaccompanyingDetails'] = $spousepartnersaccompanyingData;
        $studentData['childrenDetails'] = $childrenData;
        $studentData['familynotaccompanyingDetails'] = $familynotaccompanyingData;
        $studentData['requirementsforeuropeDetails']= $requirementsforeuropeData;

        return inertia('Students/Edit', [
            'student' => $studentData,
            'message' => 'Student updated successfully'
        ]);
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $this->authorize('update', $student);

        $requestData = $request->validated();

        $this->studentService->updateStudent($requestData, $student);

        if ($request->has('financialDetails')) {
            $this->studentService->updateFinancialDetails($request->input('financialDetails'), $student);
        }

        if ($request->has('studentEmployment')) {
            $this->studentService->updateStudentEmployment($request->input('studentEmployment'), $student);
        }

        if ($request->has('incomeDetails')) {
            $this->studentService->updateIncomeDetails($request->input('incomeDetails'), $student);
        }

         if ($request->has('studentReferences')) {
            $this->studentService->updatestudentReferences($request->input('studentReferences'), $student);
        }

         if ($request->has('passportDetails')) {
            $this->studentService->updatePassportDetails($request->input('passportDetails'), $student);
        }
        if ($request->has('firstpassportDetails')) {
            $this->studentService->updateFirstPassportDetails($request->input('firstpassportDetails'), $student);
        }
        if ($request->has('contactDetails')) {
            $this->studentService->updateContactDetails($request->input('contactDetails'), $student);
        }
                if ($request->has('parentsDetails')) {
            $this->studentService->updateParentsDetails($request->input('parentsDetails'), $student);
        }
              if ($request->has('travelDetails')) {
            $this->studentService->updateTravelDetails($request->input('travelDetails'), $student);
        }
        if($request->has('otherinformationDetails')) {
            $this->studentService->updateOtherInformationDetails($request->input('otherinformationDetails'), $student);
        }
         if($request->has('qualificationsDetails')) {
            $this->studentService->updateQualificationsDetails($request->input('qualificationsDetails'), $student);
        }
          if($request->has('immigrationDetails')) {
            $this->studentService->updateImmigrationDetails($request->input('immigrationDetails'), $student);
        }
         if($request->has('ukvisahistoryDetails')) {
            $this->studentService->updateUkVisaHistoryDetails($request->input('ukvisahistoryDetails'), $student);
        }

          if (!empty($overseastravelhistoryDetails)) {
            $this->studentService->updateOverseasTravelHistoryDetails($request->input('overseastravelhistoryDetails'), $student);
        }

         if($request->has('spousepartnersaccompanyingDetails')) {
            $this->studentService->updateSpousePartnersAccompanyingDetails($request->input('spousepartnersaccompanyingDetails'), $student);
        }

        
         if ($request->has('childrenDetails')) {
            $this->studentService->updatechildrenDetails($request->input('childrenDetails'), $student);
        }

         if($request->has('familynotaccompanyingDetails')) {
            $this->studentService->updateFamilyNotAccompanyingDetails($request->input('familynotaccompanyingDetails'), $student);
        }


          if($request->has('requirementsforeuropeDetails')) {
            $this->studentService->updateRequirementsForEuropeDetails($request->input('requirementsforeuropeDetails'), $student);
        }
                
        return redirect()->route('students.edit', $student->id)
            ->with('success', 'Student updated successfully');

    }

    public function destroy(Student $student)
    {
        $this->authorize('delete', $student);

        $this->studentService->deleteStudent($student);

        return redirect()->route('students.index')->with('message', 'Student and all passport images deleted successfully.');
    }


    public function dashboard()
    {
        return inertia('Dashboard', [
            'students' => Student::paginate(10),
            'auth' => auth()->user(),
        ]);
    }
}
