<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    protected $fillable = [
        'choice_of_country', 'intake', 'intended_course','firstname', 'middlename', 'surname', 'nickname', 'email', 
        'gender', 'nationality', 'date_of_birth', 'place_of_birth', 'national_insurance', 'other_nationalities', 
        'marital_status', 'criminal_conviction', 'police_clearance', 'disability', 
        'living_situation', 'correspondence_address'
    ];

    public function financialDetails()
    {
        return $this->hasOne(FinancialDetails::class);
    }

    public function studentEmployment()
    {
        return $this->hasMany(StudentEmployment::class);
    }
    
    public function incomeDetails()
    {
        return $this->hasOne(IncomeDetails::class);
    }
    
    public function studentReferences()
    {
        return $this->hasMany(studentReferences::class);
    }

    public function contactDetails()
    {
        return $this->hasOne(ContactDetails::class);
    }

    public function parentsDetails()
    {
        return $this->hasOne(ParentsDetails::class);
    }

    public function passportDetails()
    {
        return $this->hasOne(PassportDetails::class);
    }

    public function financialDocuments()
    {
        return $this->hasMany(FinancialDocuments::class);
    }

    public function firstPassportDetails()
    {
        return $this->hasOne(FirstPassportDetails::class);
    }

    public function travelDetails()
    {
        return $this->hasOne(TravelDetails::class);
    }

    public function otherInformationDetails()
    {
        return $this->hasOne(OtherInformationDetails::class);
    }

    public function qualificationDetails()
    {
        return $this->hasOne(QualificationDetails::class);
    }

    public function immigrationDetails()
    {
        return $this->hasOne(ImmigrationDetails::class);
    }

    public function ukVisaHistoryDetails()
    {
        return $this->hasOne(UkVisaHistoryDetails::class);
    }

    public function overseasTravelHistoryDetails()
    {
        return $this->hasOne(OverseasTravelHistoryDetails::class);
    }

    public function spouseParnersNotAccompanyingDetails()
    {
        return $this->hasOne(SpousePartnersNotAccompanyingDetails::class);
    }

    public function childrens()
    {
        return $this->hasMany(Childrens::class);
    }

    public function spouseParnersAccompanyingDetails()
    {
        return $this->hasOne(SpousePartnersAccompanyingDetails::class);
    }

    public function requirmentsForEuropeDetails()
    {
        return $this->hasOne(RequirmentsForEuropeDetails::class);
    }

    public function documentsRequired()
    {
        return $this->hasOne(DocumentsRequired::class);
    }

    public function checkCopyDetails()
    {
        return $this->hasOne(CheckCopyDetails::class);
    }
}