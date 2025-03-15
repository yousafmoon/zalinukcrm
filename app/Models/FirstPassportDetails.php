<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FirstPassportDetails extends Model
{
    protected $fillable = [
        'passport_number', 'place_of_issue', 'issuing_authority', 'date_of_issue', 
        'date_of_expiry', 'student_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}