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
            if (in_array(strtolower($value), ['yes', 'no'])) {
                return strtolower($value);
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
            'own_property' => null,
            'bank_savings' => null,
            'tuition_budget' => null,
            'bank_funds' => null,
            'tuition_payer' => null, 
        ];
    
        $financialData = $student->financialDetails 
            ? array_merge($financialDefaults, $student->financialDetails->toArray()) 
            : $financialDefaults;
    
        $booleanFields = ['own_property', 'bank_savings'];
        foreach ($booleanFields as $field) {
            if (array_key_exists($field, $financialData) && $financialData[$field] !== null) {
                $financialData[$field] = ($financialData[$field] == 'yes' || $financialData[$field] == 1) ? 'Yes' : 'No';
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
