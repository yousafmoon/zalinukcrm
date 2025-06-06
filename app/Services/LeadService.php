<?php

namespace App\Services;

use App\Models\Lead;
use App\Repositories\LeadRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LeadService
{
    protected $leadRepository;

    public function __construct(LeadRepository $leadRepository)
    {
        $this->leadRepository = $leadRepository;
    }

    public function storeLead(Request $request): Lead
    {
        return $this->leadRepository->saveLead($request->all());
    }

    public function updateLead(array $requestData, Lead $lead): void
    {
        $this->leadRepository->saveLead($requestData, $lead);
    }
   
    
    public function deleteLead(Lead $lead): void
    {
        $lead->delete();
    }

    public function getLeads(?string $search = null)
    {
        return Lead::with('leads')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('fullname', 'like', "%{$search}%")
                    ->orWhere('source', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('nationality', 'like', "%{$search}%")
                    
                });
            })
            ->paginate(10);
    }

    public function getLeadById($id): Lead
    {
        return Lead::with(['leads'])->findOrFail($id);
    }

    public function editLead(Lead $lead): Lead
    {
        return $lead->load(['leads']);
    }
    
}