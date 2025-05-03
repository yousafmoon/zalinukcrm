<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Childrens extends Model
{

    protected $fillable = [
        'full_name', 'gender', 'dob', 'place_of_birth', 'nationality', 'accompanying_uk', 'current_address','passport_number', 'student_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}