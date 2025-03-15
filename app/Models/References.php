<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class References extends Model
{
    protected $fillable = [
        'name', 'phone', 'email', 'position', 'relationship', 'duration',
        'student_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}