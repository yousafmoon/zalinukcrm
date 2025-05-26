<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OverseasTravelVisit extends Model
{
    protected $fillable = [
        'country_visited',
        'date_arrived',
        'purpose_of_visit',
        'length_of_stay',
        'region_id'
    ];

   
    public function region()
    {
        return $this->belongsTo(OverseasTravelRegion::class);
    }

}