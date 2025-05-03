<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImmigrationDetails extends Model
{
    protected $fillable = [
         'travel_outside',
         'travel_uk',
         'refused_uk_visa',
         'refused_any_visa',
         'granted_uk_visa',
         'refused_entry_uk',
         'deported_uk',
         'deported_other_country',
         'applied_home_office',
         'breach_immigration_conditions',
         'criminal_convictions',
         'charged_criminal_offence',
         'involved_in_war_crimes',
         'involved_in_terrorism',
         'activities_bad_character',
         'nhs_treatment_unpaid',
         'organization_type',
         'student_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}