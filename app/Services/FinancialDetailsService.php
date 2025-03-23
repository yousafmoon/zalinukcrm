<?php

namespace App\Services;

use App\Models\FinancialDetails;
use App\Models\Student;
use App\Repositories\FinancialDetailsRepository;

class FinancialDetailsService
{
    protected $financialDetailsRepository;

    public function __construct(FinancialDetailsRepository $financialDetailsRepository)
    {
        $this->financialDetailsRepository = $financialDetailsRepository;
    }

    /**
     * Store financial details for a student
     */
    public function storeFinancialDetails(array $data, Student $student)
    {
        $financialDetails = collect($data)->only([
            'own_property', 'bank_savings', 'tuition_budget', 'bank_funds', 'tuition_payer'
        ])->map(function ($value, $key) {
            if (in_array($value, ['yes', 'no'])) {
                return $value;
            } elseif (in_array($key, ['bank_savings', 'tuition_budget']) && !is_numeric($value)) {
                return 0;
            }
            return $value;
        })->toArray();

        if (!empty($financialDetails)) {
            $financialDetails['student_id'] = $student->id;
            return $student->financialDetails()->create($financialDetails);
        }

        return null;
    }

    /**
     * Retrieve and edit financial details for a student
     */
    public function editFinancialDetails(Student $student)
    {
        $student->load('financialDetails');
        $studentData = $student->toArray();
    
        $financialDefaults = [
            'own_property' => '',
            'bank_savings' => '',
            'tuition_budget' => '',
            'bank_funds' => '',
            'tuition_payer' => '',
        ];
    
        if ($student->financialDetails) {
            $financialData = $student->financialDetails->toArray();
        } else {
            $financialData = $financialDefaults;
        }
        $booleanFields = ['own_property', 'bank_savings', 'bank_funds'];
        
        foreach ($booleanFields as $field) {
            if (isset($financialData[$field])) {
                $financialData[$field] = $financialData[$field] ? 'Yes' : 'No';
            }
        }
    
        return array_merge($studentData, $financialData);
    }
    

    /**
     * Update financial details for a student
     */
    public function updateFinancialDetails(array $data, Student $student)
    {
        $financialFields = ['own_property', 'bank_savings', 'tuition_budget', 'bank_funds', 'tuition_payer'];
        $financialData = array_intersect_key($data, array_flip($financialFields));
        $studentData = array_diff_key($data, $financialData);

        $student->update($studentData);

        if (!empty($financialData)) {
            return $student->financialDetails()->updateOrCreate(['student_id' => $student->id], $financialData);
        }

        return null;
    }
}
