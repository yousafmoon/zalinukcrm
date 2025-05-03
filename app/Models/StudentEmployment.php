<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentEmployment extends Model
{
    protected $table = 'student_employment';
    
    protected $fillable = [
        'personal_circumstances', 'employment_details', 'present_work', 'company_name', 
        'job_start_date', 'work_address', 'employer_phone', 'employer_email', 'additional_jobs', 
        'student_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}