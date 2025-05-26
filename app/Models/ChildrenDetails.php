<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChildrenDetails extends Model
{

    protected $fillable = [
        'child_full_name', 
        'child_gender', 
        'child_dob', 
        'child_place_of_birth', 
        'child_nationality', 
        'child_accompanying_uk', 
        'child_current_address',
        'child_passport_number', 
        'student_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}