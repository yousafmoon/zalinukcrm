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
        return Student::with(['financialDetails', 'studentEmployment', 'incomeDetails', 'studentReferences'])->findOrFail($id);
    }

    public function editStudent(Student $student): Student
    {
        
        return $student->load(['financialDetails','studentEmployment', 'incomeDetails', 'studentReferences']);
    }
    
    
}