<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OverseasTravelRegion extends Model
{
    protected $fillable = [
        'region_title',
        'student_id'
    ];

    public function student()
{
    return $this->belongsTo(Student::class);
}

public function visits()
{
    return $this->hasMany(OverseasTravelVisit::class, 'region_id');
}

}