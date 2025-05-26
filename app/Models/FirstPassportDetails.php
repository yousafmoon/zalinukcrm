<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FirstPassportDetails extends Model
{
    
    protected $fillable = [
        'previous_ppt_number', 'place_of_issue_previous', 'issuing_authority_previous', 'date_of_issue_previous', 
        'date_of_expiry_previous','national_id_number', 'student_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}

