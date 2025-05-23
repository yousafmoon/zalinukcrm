<?php

namespace App\Repositories;

use App\Models\Student;
use App\Models\FinancialDetail;
use App\Models\StudentEmployment;

class StudentRepository
{
    public function saveStudent(array $data, Student $student = null): Student
    {
        $student = $student ?? new Student();
        $studentFields = array_filter($data, function($value) {
            return $value !== null;
        });

        $student->fill($studentFields);
        $student->save();

        if (!empty($data['financialDetails'])) {
            $this->saveFinancialDetails($student, $data['financialDetails']);
        }
        

        if (!empty($data['incomeDetails'])) {
            $this->saveIncomeDetails($student, $data['incomeDetails']);
        }

          if (!empty($data['studentEmployment'])) {
            $this->saveStudentEmployment($student, $data['studentEmployment']);
        }

          if (!empty($data['studentReferences'])) {
            $this->savestudentReferences($student, $data['studentReferences']);
        }

        return $student;
    }

    public function saveFinancialDetails(Student $student, array $financialData): void
    {

        $financialData['student_id'] = $student->id;
        $student->financialDetails()->updateOrCreate(
            ['student_id' => $student->id],
            $financialData
        );
    }
    
    public function saveStudentEmployment(Student $student, array $employmentData): void
    {
        $student->studentEmployment()->delete();
        
        foreach ($employmentData as $employment) {
            $filteredData = array_filter($employment, function ($value) {
                return !is_null($value) && $value !== '';
            });
    
            if (!empty($filteredData)) {
                $student->studentEmployment()->create($filteredData);
            }
        }
    }

      public function saveIncomeDetails(Student $student, array $incomeData): void
    {

        $incomeData['student_id'] = $student->id;
        $student->incomeDetails()->updateOrCreate(
            ['student_id' => $student->id],
            $incomeData
        );
    }

        public function savestudentReferences(Student $student, array $referencesData): void
    {
        $student->studentReferences()->delete();
        
        foreach ($referencesData as $reference) {
            $filteredData = array_filter($reference, function ($value) {
                return !is_null($value) && $value !== '';
            });
    
            if (!empty($filteredData)) {
                $student->studentReferences()->create($filteredData);
            }
        }
    }
    
}