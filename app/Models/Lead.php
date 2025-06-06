<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{

    protected $fillable = [
        'choice_of_country', 'intake', 'intended_course','firstname', 'middlename', 'surname', 'nickname', 'email', 
        'gender', 'nationality', 'date_of_birth', 'place_of_birth', 'national_insurance', 'other_nationalities', 
        'marital_status', 'criminal_conviction', 'police_clearance', 'disability', 
        'living_situation', 'correspondence_address'
    ];

}