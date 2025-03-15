<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckCopyDetails extends Model
{
    protected $fillable = [
        'copy_current_passport', 'copy_any_current_previous_uk_visas', 'copy_any_previous_passports', 'remarks', 'student_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}