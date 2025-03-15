<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialDocuments extends Model
{
    protected $fillable = [
        'document_title', 'document_name', 'document_path' 'student_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}