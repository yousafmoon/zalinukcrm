<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpousePartnersAccompanyingDetails extends Model
{
    protected $fillable = [
        'spouse_father_given_name',
        'spouse_father_family_name',
        'father_dob',
        'father_place_of_birth',
        'spouse_mother_given_name',
        'spouse_mother_family_name',
        'mother_dob',
        'spouse_mother_place_of_birth',
        'spouse_visa_valid_from',
        'spouse_visa_expiry_date',
        'spouse_visa_type', 
        'spouse_travel_history',
        'student_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}