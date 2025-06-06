<?php

namespace App\Repositories;

use App\Models\Lead;

class LeadRepository
{
    public function saveLead(array $data, Lead $lead = null): Lead
    {
        $lead = $lead ?? new Lead();
        $leadFields = array_filter($data, function($value) {
            return $value !== null;
        });

        $lead->fill($leadFields);
        $lead->save();
        return $lead;
    }
           
}