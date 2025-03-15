<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UkVisaHistoryDetails extends Model
{
    protected $fillable = [
        'visa_type', 'visa_valid_from', 'visa_expiry_date', 'visa_reference_number', 'student_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}