<?php

namespace App\Repositories;

use App\Models\FinancialDetails;

class FinancialDetailsRepository
{
    public function create(array $data)
    {
        return FinancialDetails::create($data);
    }

    public function update(FinancialDetails $details, array $data)
    {
        $details->update($data);
        return $details;
    }
}



?>