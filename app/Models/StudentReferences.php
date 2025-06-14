<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class studentReferences extends Model
{
    protected $fillable = [
        'ref_name', 'ref_phone', 'ref_email', 'ref_position', 'ref_relationship', 'ref_duration',
        'student_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}