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
            $this->saveStudentReferences($student, $data['studentReferences']);
        }

         if (!empty($data['passportDetails'])) {
            $this->savePassportDetails($student, $data['passportDetails']);
        }
        if (!empty($data['firstpassportDetails'])) {
            $this->saveFirstPassportDetails($student, $data['firstpassportDetails']);
        }
        if (!empty($data['contactDetails'])) {
            $this->saveContactDetails($student, $data['contactDetails']);
        }
        if (!empty($data['parentsDetails'])) {
            $this->saveParentsDetails($student, $data['parentsDetails']);
        }
         if (!empty($data['travelDetails'])) {
            $this->saveTravelDetails($student, $data['travelDetails']);
        }
        if (!empty($data['otherinformationDetails'])) {
            $this->saveOtherInformationDetails($student, $data['otherinformationDetails']);
        }
        if (!empty($data['qualificationsDetails'])) {
            $this->saveQualificationsDetails($student, $data['qualificationsDetails']);
        }
         if (!empty($data['immigrationDetails'])) {
            $this->saveImmigrationDetails($student, $data['immigrationDetails']);
        }
           if (!empty($data['ukvisahistoryDetails'])) {
            $this->saveUkVisaHistoryDetails($student, $data['ukvisahistoryDetails']);
        }

        if (!empty($data['overseastravelhistoryDetails'])) {
            $this->saveOverseasTravelHistoryDetails($student, $data['overseastravelhistoryDetails']);
        }


           if (!empty($data['spousepartnersaccompanyingDetails'])) {
            $this->saveSpousePartnersAccompanyingDetails($student, $data['spousepartnersaccompanyingDetails']);
        }

         if (!empty($data['childrenDetails'])) {
            $this->savechildrenDetails($student, $data['childrenDetails']);
        }


         if (!empty($data['familynotaccompanyingDetails'])) {
            $this->saveFamilyNotAccompanyingDetails($student, $data['familynotaccompanyingDetails']);
        }

       
          if (!empty($data['requirementsforeuropeDetails'])) {
            $this->saveRequirementsForEuropeDetails($student, $data['requirementsforeuropeDetails']);
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

        public function saveStudentReferences(Student $student, array $referencesData): void
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

         public function savePassportDetails(Student $student, array $passportData): void
    {

        $passportData['student_id'] = $student->id;
        $student->passportDetails()->updateOrCreate(
            ['student_id' => $student->id],
            $passportData
        );
    }

        public function saveFirstPassportDetails(Student $student, array $firstpassportData): void
        {
            $firstpassportData['student_id'] = $student->id;
            $student->firstpassportDetails()->updateOrCreate(
                ['student_id' => $student->id],
                $firstpassportData
            );
        }

        public function saveContactDetails(Student $student, array $contactData): void
        {

            $contactData['student_id'] = $student->id;
            $student->contactDetails()->updateOrCreate(
                ['student_id' => $student->id],
                $contactData
            );
        }

          public function saveParentsDetails(Student $student, array $parentsData): void
        {

            $parentsData['student_id'] = $student->id;
            $student->parentsDetails()->updateOrCreate(
                ['student_id' => $student->id],
                $parentsData
            );
        }

        public function saveTravelDetails(Student $student, array $travelData): void
        {

            $travelData['student_id'] = $student->id;
            $student->travelDetails()->updateOrCreate(
                ['student_id' => $student->id],
                $travelData
            );
        }

        public function saveOtherInformationDetails(Student $student, array $oiData): void
        {

            $oiData['student_id'] = $student->id;
            $student->otherinformationDetails()->updateOrCreate(
                ['student_id' => $student->id],
                $oiData
            );
        }

          public function saveQualificationsDetails(Student $student, array $oiData): void
        {

            $oiData['student_id'] = $student->id;
            $student->qualificationsDetails()->updateOrCreate(
                ['student_id' => $student->id],
                $oiData
            );
        }

        
          public function saveImmigrationDetails(Student $student, array $immigrationData): void
        {

            $immigrationData['student_id'] = $student->id;
            $student->immigrationDetails()->updateOrCreate(
                ['student_id' => $student->id],
                $immigrationData
            );
        }

             public function saveUkVisaHistoryDetails(Student $student, array $ukvisaData): void
        {

            $ukvisaData['student_id'] = $student->id;
            $student->ukvisahistoryDetails()->updateOrCreate(
                ['student_id' => $student->id],
                $ukvisaData
            );
        }

        public function saveOverseasTravelHistoryDetails(Student $student, array $travelHistoryData): void
        {
            $student->overseastravelhistoryDetails()->delete();

            foreach ($travelHistoryData as $regionData) {
                if (empty($regionData['region_title'])) {
                    continue;
                }

                $region = $student->overseastravelhistoryDetails()->create([
                    'region_title' => $regionData['region_title'],
                ]);

                if (!empty($regionData['visits'])) {
                    foreach ($regionData['visits'] as $visit) {
                        $filteredVisit = array_filter($visit, fn($value) => !is_null($value) && $value !== '');
                        if (!empty($filteredVisit)) {
                            $region->visits()->create($filteredVisit);
                        }
                    }
                }
            }
        }


        public function saveSpousePartnersAccompanyingDetails(Student $student, array $spouseaccompanyingData): void
        {

            $spouseaccompanyingData['student_id'] = $student->id;
            $student->spousepartnersaccompanyingDetails()->updateOrCreate(
                ['student_id' => $student->id],
                $spouseaccompanyingData
            );
        }

          public function savechildrenDetails(Student $student, array $childrenData): void
    {
        $student->childrenDetails()->delete();
        
        foreach ($childrenData as $child) {
            $filteredData = array_filter($child, function ($value) {
                return !is_null($value) && $value !== '';
            });
    
            if (!empty($filteredData)) {
                $student->childrenDetails()->create($filteredData);
            }
        }
    }

             public function saveFamilyNotAccompanyingDetails(Student $student, array $familynotaccompanyingData): void
        {

            $familynotaccompanyingData['student_id'] = $student->id;
            $student->familynotaccompanyingDetails()->updateOrCreate(
                ['student_id' => $student->id],
                $familynotaccompanyingData
            );
        }



          public function saveRequirementsForEuropeDetails(Student $student, array $requirementsforeuropeData): void
        {

            $requirementsforeuropeData['student_id'] = $student->id;
            $student->requirementsforeuropeDetails()->updateOrCreate(
                ['student_id' => $student->id],
                $requirementsforeuropeData
            );
        }

        

        

    
}