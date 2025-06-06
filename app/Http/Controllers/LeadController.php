<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreLeadRequest;
use App\Http\Requests\UpdateLeadRequest;
use App\Http\Resources\LeadResource;
use App\Models\Lead;
use App\Services\LeadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class LeadController extends Controller
{
    protected $leadService;

        public function __construct(LeadService $leadService)
        {
             $this->leadService = $leadService;
            $this->middleware('can:viewAny,App\Models\Lead');
        }

    public function index(Request $request)
    {
        $this->authorize('viewAny', Lead::class);

        $leads = $this->leadService->getLeads($request->search);

        return inertia('Leads/Index', [
            'leads' => LeadResource::collection($leads),
            'search' => $request->search ?? '',
            'totalLeads' => $leads->total(),
        ]);
    }

    public function show($id)
    {
        $lead = $this->leadService->getLeadById($id);

        return inertia('Leads/View', [
            'lead' => $lead,
        ]);
    }

    public function create()
    {
        $this->authorize('create', Lead::class);
        return inertia('Leads/Create');
    }

    public function store(StoreLeadRequest $request)
    {
        $this->authorize('create', Lead::class);
        $lead = $this->leadService->storeLead($request);
        if (!$lead || !$lead->id) {
            return back()->with('error', 'Failed to create lead.');
        }
    
        return redirect()->route('leads.index')->with('message', 'Lead created successfully.');
    }

    public function edit(Lead $lead)
    {
        $this->authorize('update', $lead);
        $leadData = $lead->toArray();
        return inertia('Leads/Edit', [
            'lead' => $leadData,
            'message' => 'Lead updated successfully'
        ]);
    }

    public function update(UpdateLeadRequest $request, Lead $lead)
    {
        $this->authorize('update', $lead);

        $requestData = $request->validated();

        $this->leadService->updateLead($requestData, $lead);
                
        return redirect()->route('leads.edit', $lead->id)
            ->with('success', 'Lead updated successfully');

    }

    public function destroy(Lead $lead)
    {
        $this->authorize('delete', $lead);

        $this->leadService->deleteLead($lead);

        return redirect()->route('leads.index')->with('message', 'Lead and all passport images deleted successfully.');
    }


    public function dashboard()
    {
        return inertia('Dashboard', [
            'leads' => Lead::paginate(10),
            'auth' => auth()->user(),
        ]);
    }
}
