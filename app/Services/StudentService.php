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

    public function updateStudent(Request $request, Student $student): void
    {
        $this->studentRepository->saveStudent($request->all(), $student);
    }

    public function updateFinancialDetails(array $financialDetails, Student $student): void
    {
        foreach ($financialDetails as $details) {
            $this->studentRepository->saveFinancialDetails($student, $details);
        }
    }

    public function updateStudentEmployment(array $employmentData, Student $student): void
    {
        foreach ($employmentData as $employment) {
            $this->studentRepository->saveStudentEmployment($student, $employment);
        }
    }

    public function deleteStudent(Student $student): void
    {
        $student->delete();
    }

    public function getStudents(?string $search = null)
    {
        return Student::when($search, fn($query) =>
            $query->where('name', 'like', "%{$search}%")
        )->paginate(10);
    }

    public function getStudentById($id): Student
    {
        return Student::with(['financialDetails', 'studentEmployment'])->findOrFail($id);
    }

    public function editStudent(Student $student): Student
    {
        
        return $student->load([
            'financialDetails',
            'studentEmployment' => function($query) {
                $query->orderBy('created_at', 'desc');
            } 
        ]);
    }
    
    
}
