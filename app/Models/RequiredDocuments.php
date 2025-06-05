<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Documents;

class RequiredDocuments extends Model
{

    protected $fillable = [
        'document_type',
        'file_name',
        'original_name',
        'file_path',
        'uploaded_at',
        'document_id'
    ];

    
 public function documents()
    {
        return $this->belongsTo(Documents::class);
    }
}
