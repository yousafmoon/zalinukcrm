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
        return $this->hasMany(StudentReferences::class);
    }

    public function passportDetails()
    {
        return $this->hasOne(PassportDetails::class);
    }

    public function financialDocuments()
    {
        return $this->hasMany(FinancialDocuments::class);
    }

    public function firstpassportDetails()
    {
        return $this->hasOne(FirstPassportDetails::class);
    }

    public function contactDetails()
    {
        return $this->hasOne(ContactDetails::class);
    }
    
    public function parentsDetails()
    {
        return $this->hasOne(ParentsDetails::class);
    }

    public function travelDetails()
    {
        return $this->hasOne(TravelDetails::class);
    }

    public function otherInformationDetails()
    {
        return $this->hasOne(OtherInformationDetails::class);
    }

    public function qualificationsDetails()
    {
        return $this->hasOne(QualificationsDetails::class);
    }

    public function immigrationDetails()
    {
        return $this->hasOne(ImmigrationDetails::class);
    }

    public function ukVisaHistoryDetails()
    {
        return $this->hasOne(UkVisaHistoryDetails::class);
    }

   public function overseastravelhistoryDetails()
    {
        return $this->hasMany(OverseasTravelRegion::class);
    }

    public function spousepartnersaccompanyingDetails()
    {
        return $this->hasOne(SpousePartnersAccompanyingDetails::class);
    }

    public function childrenDetails()
    {
        return $this->hasMany(ChildrenDetails::class);
    }

        public function familynotaccompanyingDetails()
    {
        return $this->hasOne(FamilyNotAccompanyingDetails::class);
    }

    public function requirementsforeuropeDetails()
    {
        return $this->hasOne(RequirementsForEuropeDetails::class);
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