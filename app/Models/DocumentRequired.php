<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentRequired extends Model
{
    use HasFactory;

    // Define table name explicitly if it does not follow Laravel naming conventions
    protected $table = 'documentrequired';

    // Mass assignable fields
    protected $fillable = [
        'file_title',        
        'file_name',    
        'file_path',    
        'student_id' 
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
