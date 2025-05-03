<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpousePartnersNotAccompanyingDetails extends Model
{
    protected $fillable = [
        'spouse_given_name', 'spouse_family_name', 'spouse_passport_number', 'spouse_location', 'spouse_dob', 'spouse_nationality','spouse_accompanying_uk', 'student_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}