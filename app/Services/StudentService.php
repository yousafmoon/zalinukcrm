<?php

namespace App\Services;

use App\Models\Student;
use App\Repositories\StudentRepository;
use Illuminate\Http\Request;

class StudentService
{
    protected $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function storeStudent(Request $request): Student
    {
        return $this->studentRepository->saveStudent($request->all());
    }

    public function storeFinancialDetails(array $financialDetails, Student $student): void
    {
        $this->studentRepository->saveFinancialDetails($student, $financialDetails);
    }
    
    public function storeStudentEmployment(array $employmentData, Student $student): void
    {
        $this->studentRepository->saveStudentEmployment($student, $employmentData);
    }

     public function storeIncomeDetails(array $incomeDetails, Student $student): void
    {
        $this->studentRepository->saveIncomeDetails($student, $incomeDetails);
    }

      public function storestudentReferences(array $referencesData, Student $student): void
    {
        $this->studentRepository->savestudentReferences($student, $referencesData);
    }

      public function storePassportDetails(array $passportDetails, Student $student): void
    {
        $this->studentRepository->savePassportDetails($student, $passportDetails);
    }

       public function storeFirstPassportDetails(array $firstpassportDetails, Student $student): void
    {
        $this->studentRepository->saveFirstPassportDetails($student, $firstpassportDetails);
    }

        public function storeContactDetails(array $contactDetails, Student $student): void
    {
        $this->studentRepository->saveContactDetails($student, $contactDetails);
    }

          public function storeParentsDetails(array $parentsDetails, Student $student): void
    {
        $this->studentRepository->saveParentsDetails($student, $parentsDetails);
    }
        public function storeTravelDetails(array $travelDetails, Student $student): void
    {
        $this->studentRepository->saveTravelDetails($student, $travelDetails);
    }

     public function storeOtherInformationDetails(array $otherinformationDetails, Student $student): void
    {
        $this->studentRepository->saveOtherInformationDetails($student, $otherinformationDetails);
    }

      public function storeQualificationsDetails(array $qualificationsDetails, Student $student): void
    {
        $this->studentRepository->saveQualificationsDetails($student, $qualificationsDetails);
    }

       public function storeImmigrationDetails(array $immigrationDetails, Student $student): void
    {
        $this->studentRepository->saveImmigrationDetails($student, $immigrationDetails);
    }

         public function storeUkVisaHistoryDetails(array $ukvisahistoryDetails, Student $student): void
    {
        $this->studentRepository->saveUkVisaHistoryDetails($student, $ukvisahistoryDetails);
    }

      public function storeOverseasTravelHistoryDetails(array $overseasTravelHistoryDetails, Student $student): void
    {
        $this->studentRepository->saveOverseasTravelHistoryDetails($student, $overseasTravelHistoryDetails);
    }

    public function storeSpousePartnersAccompanyingDetails(array $spousepartnersaccompanyingDetails, Student $student): void
    {
        $this->studentRepository->saveSpousePartnersAccompanyingDetails($student, $spousepartnersaccompanyingDetails);
    }

      public function storechildrenDetails(array $childrenData, Student $student): void
    {
        $this->studentRepository->savechildrenDetails($student, $childrenData);
    }

     public function storeFamilyNotAccompanyingDetails(array $familynotaccompanyingDetails, Student $student): void
    {
        $this->studentRepository->saveFamilyNotAccompanyingDetails($student, $familynotaccompanyingDetails);
    }


      public function storeRequirementsForEuropeDetails(array $requirementsforeuropeDetails, Student $student): void
    {
        $this->studentRepository->saveRequirementsForEuropeDetails($student, $requirementsforeuropeDetails);
    }


    public function updateStudent(array $requestData, Student $student): void
    {
        $this->studentRepository->saveStudent($requestData, $student);
    }
    public function updateFinancialDetails($requestData, Student $student): void
    {
        $financialDetails = is_array($requestData)
            ? $requestData
            : json_decode($requestData, true);
    
        if (!is_array($financialDetails) || json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Invalid financialDetails data.');
        }
    
        $this->studentRepository->saveFinancialDetails($student, $financialDetails);
    }
    
    public function updateStudentEmployment($requestData, Student $student): void
    {
        $employmentData = is_array($requestData)
            ? $requestData
            : json_decode($requestData, true);
    
        if (!is_array($employmentData) || json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Invalid studentEmployment data.');
        }
    
        $this->studentRepository->saveStudentEmployment($student, $employmentData);
    }

        public function updateIncomeDetails($requestData, Student $student): void
    {
        $incomeDetails = is_array($requestData)
            ? $requestData
            : json_decode($requestData, true);
    
        if (!is_array($incomeDetails) || json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Invalid incomeDetails data.');
        }
    
        $this->studentRepository->saveIncomeDetails($student, $incomeDetails);
    }

        public function updatestudentReferences($requestData, Student $student): void
    {
        $referencesData = is_array($requestData)
            ? $requestData
            : json_decode($requestData, true);
    
        if (!is_array($referencesData) || json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Invalid studentReferences data.');
        }
    
        $this->studentRepository->savestudentReferences($student, $referencesData);
    }

            public function updatePassportDetails($requestData, Student $student): void
    {
        $passportDetails = is_array($requestData)
            ? $requestData
            : json_decode($requestData, true);
    
        if (!is_array($passportDetails) || json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Invalid passportDetails data.');
        }
    
        $this->studentRepository->savePassportDetails($student, $passportDetails);
    }

    public function updateFirstPassportDetails($requestData, Student $student): void
    {
        $firstpassportDetails = is_array($requestData)
            ? $requestData
            : json_decode($requestData, true);
    
        if (!is_array($firstpassportDetails) || json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Invalid firstpassportDetails data.');
        }
    
        $this->studentRepository->saveFirstPassportDetails($student, $firstpassportDetails);
    }

     public function updateContactDetails($requestData, Student $student): void
    {
        $contactDetails = is_array($requestData)
            ? $requestData
            : json_decode($requestData, true);
    
        if (!is_array($contactDetails) || json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Invalid contactDetails data.');
        }
    
        $this->studentRepository->saveContactDetails($student, $contactDetails);
    }

         public function updateParentsDetails($requestData, Student $student): void
    {
        $parentsDetails = is_array($requestData)
            ? $requestData
            : json_decode($requestData, true);
    
        if (!is_array($parentsDetails) || json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Invalid parentsDetails data.');
        }
    
        $this->studentRepository->saveParentsDetails($student, $parentsDetails);
    }
         public function updateTravelDetails($requestData, Student $student): void
    {
        $travelDetails = is_array($requestData)
            ? $requestData
            : json_decode($requestData, true);
    
        if (!is_array($travelDetails) || json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Invalid travelDetails data.');
        }
    
        $this->studentRepository->saveTravelDetails($student, $travelDetails);
    }

     public function updateOtherInformationDetails($requestData, Student $student): void
    {
        $otherinformationDetails = is_array($requestData)
            ? $requestData
            : json_decode($requestData, true);
    
        if (!is_array($otherinformationDetails) || json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Invalid otherinformationDetails data.');
        }
    
        $this->studentRepository->saveOtherInformationDetails($student, $otherinformationDetails);
    }

         public function updateQualificationsDetails($requestData, Student $student): void
    {
        $qualificationsDetails = is_array($requestData)
            ? $requestData
            : json_decode($requestData, true);
    
        if (!is_array($qualificationsDetails) || json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Invalid qualificationsDetails data.');
        }
    
        $this->studentRepository->saveQualificationsDetails($student, $qualificationsDetails);
    }

     public function updateImmigrationDetails($requestData, Student $student): void
    {
        $immigrationDetails = is_array($requestData)
            ? $requestData
            : json_decode($requestData, true);
    
        if (!is_array($immigrationDetails) || json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Invalid immigrationDetails data.');
        }
    
        $this->studentRepository->saveImmigrationDetails($student, $immigrationDetails);
    }

         public function updateUkVisaHistoryDetails($requestData, Student $student): void
    {
        $ukvisahistoryDetails = is_array($requestData)
            ? $requestData
            : json_decode($requestData, true);
    
        if (!is_array($ukvisahistoryDetails) || json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Invalid ukvisahistoryDetails data.');
        }
    
        $this->studentRepository->saveUkVisaHistoryDetails($student, $ukvisahistoryDetails);
    }

     public function updateOverseasTravelHistoryDetails($requestData, Student $student): void
    {
        $overseasTravelHistoryDetails = is_array($requestData)
            ? $requestData
            : json_decode($requestData, true);

        if (!is_array($overseasTravelHistoryDetails) || json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Invalid overseasTravelHistoryDetails data.');
        }

        $this->studentRepository->saveOverseasTravelHistoryDetails($student, $overseasTravelHistoryDetails);
    }

     public function updateSpousePartnersAccompanyingDetails($requestData, Student $student): void
    {
        $spousepartnersaccompanyingDetails = is_array($requestData)
            ? $requestData
            : json_decode($requestData, true);
    
        if (!is_array($spousepartnersaccompanyingDetails) || json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Invalid spousepartnersaccompanyingDetails data.');
        }
    
        $this->studentRepository->saveSpousePartnersAccompanyingDetails($student, $spousepartnersaccompanyingDetails);
    }


      public function updatechildrenDetails($requestData, Student $student): void
    {
        $childrenData = is_array($requestData)
            ? $requestData
            : json_decode($requestData, true);
    
        if (!is_array($childrenData) || json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Invalid childrenData data.');
        }
    
        $this->studentRepository->savechildrenDetails($student, $childrenData);
    }



         public function updateFamilyNotAccompanyingDetails($requestData, Student $student): void
    {
        $familynotaccompanyingDetails = is_array($requestData)
            ? $requestData
            : json_decode($requestData, true);
    
        if (!is_array($familynotaccompanyingDetails) || json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Invalid familyaccompanyingDetails data.');
        }
    
        $this->studentRepository->saveFamilyNotAccompanyingDetails($student, $familynotaccompanyingDetails);
    }



         public function updateRequirementsForEuropeDetails($requestData, Student $student): void
    {
        $requirementsforeuropeDetails = is_array($requestData)
            ? $requestData
            : json_decode($requestData, true);
    
        if (!is_array($requirementsforeuropeDetails) || json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Invalid requirementsforeuropeDetails data.');
        }
    
        $this->studentRepository->saveRequirementsForEuropeDetails($student, $requirementsforeuropeDetails);
    }
    
    public function deleteStudent(Student $student): void
    {
        $student->delete();
    }

    public function getStudents(?string $search = null)
    {
        return Student::when($search, fn($query) =>
            $query->where('firstname', 'like', "%{$search}%")
        )->paginate(10);
    }

    public function getStudentById($id): Student
    {
        return Student::with(['financialDetails', 'studentEmployment', 'incomeDetails', 'studentReferences', 
        'passportDetails','firstpassportDetails','contactDetails', 'parentsDetails', 'travelDetails',
        'otherinformationDetails', 'qualificationsDetails', 'immigrationDetails', 'ukvisahistoryDetails',
        'overseastravelhistoryDetails', 'spousepartnersaccompanyingDetails', 'familynotaccompanyingDetails', 
        'requirementsforeuropeDetails'])->findOrFail($id);
    }

    public function editStudent(Student $student): Student
    {
        return $student->load(['financialDetails','studentEmployment', 'incomeDetails', 'studentReferences', 
        'passportDetails', 'firstpassportDetails', 'contactDetails', 'parentsDetails', 'travelDetails', 
        'otherinformationDetails', 'qualificationsDetails', 'immigrationDetails', 'ukvisahistoryDetails', 
        'overseastravelhistoryDetails', 'spousepartnersaccompanyingDetails', 'familynotaccompanyingDetails', 
        'requirementsforeuropeDetails']);
    }
    
}