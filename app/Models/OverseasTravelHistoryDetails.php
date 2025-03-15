<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OverseasTravelHistoryDetails extends Model
{
    protected $fillable = [
        'uk_country_visited',
        'uk_date_arrived',
        'uk_purpose_of_visit',
        'uk_length_of_stay ',
        'europe_country_visited',
        'europe_date_arrived',
        'europe_purpose_of_visit',
        'europe_length_of_stay',
        'acnz_usa_country_visited',
        'acnz_usa_date_arrived',
        'acnz_usa_purpose_of_visit',
        'acnz_usa_length_of_stay',
        'row_country_visited',
        'row_date_arrived',
        'row_purpose_of_visit',
        'row_length_of_stay',
        'student_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}