<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParentsDetails extends Model
{
    protected $fillable = [
        'father_given_name', 'father_family_name', 'father_date_of_birth', 
        'father_place_of_birth', 'father_nationality', 
        'mother_given_name', 'mother_family_name', 'mother_date_of_birth', 
        'mother_place_of_birth', 'mother_nationality', 'student_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}