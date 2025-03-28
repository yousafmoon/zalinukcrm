<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelDetails extends Model
{
    protected $fillable = [
        'travel_date', 'student_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}