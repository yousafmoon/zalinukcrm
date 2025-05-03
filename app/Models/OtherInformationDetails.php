<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtherInformationDetails extends Model
{
    protected $fillable = [
        'family_in_uk', 'travelling_with_others', 'student_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}