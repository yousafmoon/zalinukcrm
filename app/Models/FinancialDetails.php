<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialDetails extends Model
{
    protected $fillable = [
        'own_property', 'bank_savings', 'tuition_budget', 'bank_funds', 'tuition_payer', 
        'student_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}