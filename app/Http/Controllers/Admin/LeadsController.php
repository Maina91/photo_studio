<?php

namespace App\Http\Controllers\Admin;

use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Lead;
use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreLeadRequest;
use App\Http\Requests\UpdateLeadRequest;
use App\Http\Requests\MassDestroyLeadRequest;
use Illuminate\Support\Facades\DB;

class LeadsController extends Controller
{
    public function index()
    {
        $leads = Lead::with('client')->get();
        // dd($leads);
        return view('admin.leads.index', compact('leads'));
    }

    public function create()
    {
        abort_if(Gate::denies('lead_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::all();
        return view('admin.leads.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'nullable|exists:clients,id',
            'lead_name' => 'required|string|max:255',
            'job_type' => 'required|string',
            'scheduled_at' => 'nullable|date',
            'notes' => 'nullable|string',
            'status' => 'required|in:new,follow-up,quoted,won,lost',
            'estimated_budget' => 'nullable|numeric',
            'source' => 'nullable|string|max:255',
            'signed_contract' => 'boolean',
        ]);

        Lead::create($validated);


        flash()->success('Lead created successfully.');
        return redirect()->route('admin.leads.index');
    }

    public function edit($id)
    {
        $lead = Lead::findOrFail($id);
        $clients = Client::all(); // Fetch clients for dropdown
        return view('admin.leads.edit', compact('lead', 'clients'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'lead_name' => 'required|string|max:255',
            'client_id' => 'nullable|exists:clients,id',
            'job_type' => 'required|string|max:255',
            'scheduled_at' => 'nullable|date',
            'notes' => 'nullable|string',
            'status' => 'required|in:new,contacted,converted,canceled',
        ]);

        $lead = Lead::findOrFail($id);
        $lead->update($request->all());

        flash()->success('Lead updated successfully.');

        return redirect()->route('admin.leads.index');
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();
        return redirect()->route('admin.leads.index')->with('success', 'Lead deleted successfully.');
    }

    public function show(Client $client)
    {
        abort_if(Gate::denies('client_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.leads.show', compact('client'));
    }
}
