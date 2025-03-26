<?php
namespace App\Models;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;

class Student extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'choice_of_country', 'intake', 'intended_course','firstname', 'middlename', 'surname', 'nickname', 'email', 
        'gender', 'nationality', 'date_of_birth', 'place_of_birth', 'national_insurance', 'other_nationalities', 
        'marital_status', 'criminal_conviction', 'police_clearance', 'disability', 'fircopy', 
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
    
    public function IncomeDetails()
    {
        return $this->hasOne(IncomeDetails::class);
    }

    public function ContactDetails()
    {
        return $this->hasOne(ContactDetails::class);
    }

    public function ParentsDetails()
    {
        return $this->hasOne(ParentsDetails::class);
    }

    public function PassportDetails()
    {
        return $this->hasOne(PassportDetails::class);
    }

    public function References()
    {
        return $this->hasMany(References::class);
    }

    public function FinancialDocuments()
    {
        return $this->hasMany(FinancialDocuments::class);
    }

    public function FirstPassportDetails()
    {
        return $this->hasOne(FirstPassportDetails::class);
    }

    public function TravelDetails()
    {
        return $this->hasOne(TravelDetails::class);
    }

    public function OtherInformationDetails()
    {
        return $this->hasOne(OtherInformationDetails::class);
    }

    public function QualificationDetails()
    {
        return $this->hasOne(QualificationDetails::class);
    }

    public function ImmigrationDetails()
    {
        return $this->hasOne(ImmigrationDetails::class);
    }

    public function UkVisaHistoryDetails()
    {
        return $this->hasOne(UkVisaHistoryDetails::class);
    }

    public function OverseasTravelHistoryDetails()
    {
        return $this->hasOne(OverseasTravelHistoryDetails::class);
    }

    public function SpouseParnersNotAccompanyingDetails()
    {
        return $this->hasOne(SpousePartnersNotAccompanyingDetails::class);
    }

    public function Childrens()
    {
        return $this->hasMany(Childrens::class);
    }

    public function SpouseParnersAccompanyingDetails()
    {
        return $this->hasOne(SpousePartnersAccompanyingDetails::class);
    }

    public function RequirmentsForEuropeDetails()
    {
        return $this->hasOne(RequirmentsForEuropeDetails::class);
    }

    public function DocumentsRequired()
    {
        return $this->hasOne(DocumentsRequired::class);
    }

    public function CheckCopyDetails()
    {
        return $this->hasOne(CheckCopyDetails::class);
    }
}