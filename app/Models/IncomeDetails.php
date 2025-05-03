<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeDetails extends Model
{
    protected $fillable = [
        'monthly_income', 'income_from_others', 'other_income_sources','monthly_income_given_to_family','monthly_living_costs', 'student_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}