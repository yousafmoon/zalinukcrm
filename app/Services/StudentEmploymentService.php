<?php

namespace App\Services;

use App\Models\StudentEmployment;
use App\Models\Student;
use App\Repositories\StudentEmploymentRepository;

class StudentEmploymentService
{
    protected $studentEmploymentRepository;

    public function __construct(StudentEmploymentRepository $studentEmploymentRepository)
    {
        $this->studentEmploymentRepository = $studentEmploymentRepository;
    }

    /**
     * Store Student Employment Data
     */

     public function storeStudentEmployment(array $data, Student $student) 
     {
        
         if (!isset($data['StudentEmployment']) || !is_array($data['StudentEmployment'])) {
             return;
         }
     
         foreach ($data['StudentEmployment'] as $employment) {
             $employmentRecord = [
                 'student_id' => $student->id, 
                 'personal_circumstances' => $employment['personal_circumstances'] ?? null,
                 'employment_details' => $employment['employment_details'] ?? null,
                 'present_work' => $employment['present_work'] ?? null,
                 'company_name' => $employment['company_name'] ?? null,
                 'job_start_date' => $employment['job_start_date'] ?? null,
                 'work_address' => $employment['work_address'] ?? null,
                 'employer_phone' => $employment['employer_phone'] ?? null,
                 'employer_email' => $employment['employer_email'] ?? null,
                 'additional_jobs' => $employment['additional_jobs'] ?? null,
             ];
     
             if (!array_filter($employmentRecord)) {
                 continue;
             }
             $student->studentEmployment()->create($employmentRecord);
         }
     }
     

    /**
     * Get Student Employment Data for Editing
     */
    public function editStudentEmployment(Student $student)
    {
        return $student->studentEmployment()->get();
    }

    /**
     * Update Student Employment Data
     */
    public function updateStudentEmployment(array $data, Student $student)
    {
        if (!isset($data['StudentEmployment']) || !is_array($data['StudentEmployment'])) {
            return;
        }

        foreach ($data['StudentEmployment'] as $employment) {
            if (!isset($employment['id'])) {
                continue; // Skip if no ID is provided (prevents unwanted creation)
            }

            $employmentRecord = StudentEmployment::find($employment['id']);

            if ($employmentRecord) {
                // Update existing record
                $employmentRecord->update([
                    'personal_circumstances' => $employment['personal_circumstances'] ?? null,
                    'employment_details' => $employment['employment_details'] ?? null,
                    'present_work' => $employment['present_work'] ?? null,
                    'company_name' => $employment['company_name'] ?? null,
                    'job_start_date' => $employment['job_start_date'] ?? null,
                    'work_address' => $employment['work_address'] ?? null,
                    'employer_phone' => $employment['employer_phone'] ?? null,
                    'employer_email' => $employment['employer_email'] ?? null,
                    'additional_jobs' => $employment['additional_jobs'] ?? null,
                ]);
            }
        }
    }
}
