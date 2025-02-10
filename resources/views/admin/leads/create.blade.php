@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.lead.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.leads.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="form-group">
            <label for="client_id">Client</label>
            <select name="client_id" id="client_id" class="form-control">
                <option value="">Select Client</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="lead_name">Lead Name</label>
            <input type="text" name="lead_name" id="lead_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="job_type">Job Type</label>
            <select name="job_type" id="job_type" class="form-control">
                <option value="Photography">Photography</option>
                <option value="Videography">Videography</option>
                <option value="Event Planning">Event Planning</option>
            </select>
        </div>

        <div class="form-group">
            <label for="scheduled_at">Scheduled Date</label>
            <input type="datetime-local" name="scheduled_at" id="scheduled_at" class="form-control">
        </div>

        <div class="form-group">
            <label for="estimated_budget">Estimated Budget (KES)</label>
            <input type="number" name="estimated_budget" id="estimated_budget" class="form-control">
        </div>

        <div class="form-group">
            <label for="source">Lead Source</label>
            <input type="text" name="source" id="source" class="form-control" placeholder="e.g., Social Media, Referral">
        </div>

        <div class="form-group">
            <label for="notes">Notes</label>
            <textarea name="notes" id="notes" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="status">Lead Status</label>
            <select name="status" id="status" class="form-control">
                <option value="new">New</option>
                <option value="follow-up">Follow Up</option>
                <option value="quoted">Quoted</option>
                <option value="won">Won</option>
                <option value="lost">Lost</option>
            </select>
        </div>

        <div class="form-check">
            <input type="checkbox" name="signed_contract" id="signed_contract" class="form-check-input">
            <label for="signed_contract" class="form-check-label">Signed Contract?</label>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Create Lead</button>
    </form>
</div>
</div>
@endsection
