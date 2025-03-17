<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentsRequired extends Model
{
    protected $table = 'documents_required';
    // Mass assignable fields
    protected $fillable = ['file_title','file_name','file_path','student_id' 
    ];

    /**
     * Relationship: Each document belongs to a student
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Accessor: Get full file URL
     */
    public function getFileUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }
}
