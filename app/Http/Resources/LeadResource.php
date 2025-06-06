<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge([
            'id' => $this->id,
            'choice_of_country' => $this->choice_of_country,
            'intake' => $this->intake,
            'intended_course' => $this->intended_course,
            'firstname' => $this->firstname,
            'middlename' => $this->middlename,
            'surname' => $this->surname,
            'nickname' => $this->nickname,
            'email' => $this->email,
            'gender' => $this->gender,
            'nationality' => $this->nationality,
            'date_of_birth' => $this->date_of_birth,
            'place_of_birth' => $this->place_of_birth,
            'national_insurance' => $this->national_insurance,
            'other_nationalities' => $this->other_nationalities,
            'marital_status' => $this->marital_status,
            'criminal_conviction' => $this->criminal_conviction,
            'police_clearance' => $this->police_clearance,
            'disability' => $this->disability,
            'fircopy' => $this->fircopy,
            'living_situation' => $this->living_situation,
            'correspondence_address' => $this->correspondence_address,
        ]);
    }
}