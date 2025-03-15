<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QualificationDetails extends Model
{
    protected $fillable = [
        'qualifications', 'study_institution', 'subjects_studied', 'date_passed', 'study_gap_after_last_degree', 'can_you_justify_gap', 'student_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}