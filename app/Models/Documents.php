<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RequiredDocuments;

class Documents extends Model
{
    
    protected $fillable = [
        'student_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }


    public function requiredDocuments()
    {
        return $this->hasMany(RequiredDocuments::class, 'document_id');
    }

}
