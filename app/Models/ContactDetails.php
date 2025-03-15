<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactDetails extends Model
{
    protected $fillable = [
        'address', 'postal_code', 'how_long_lived', 'home_number', 'mobile_number', 
        'email_address', 'contact_during_application', 'main_address_uk', 'ownership_status', 
        'student_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}