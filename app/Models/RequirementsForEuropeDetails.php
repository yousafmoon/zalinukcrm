<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequirementsForEuropeDetails extends Model
{
    
    protected $fillable = [
        'do_you_have_block_account', 'have_you_legalised_documents', 'bonafide_student_undertaking', 'student_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}