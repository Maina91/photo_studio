@extends('layouts.admin')

@section('content')

<div class="container">
    <h2>Edit Lead</h2>


    <form action="{{ route('admin.leads.update', [$lead->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="lead_name">Lead Name:</label>
            <input type="text" name="lead_name" id="lead_name" class="form-control" value="{{ old('lead_name', $lead->lead_name) }}" required>
        </div>

        <div class="form-group">
            <label for="client_id">Client:</label>
            <select name="client_id" id="client_id" class="form-control">
                <option value="">Select Client</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ $lead->client_id == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="job_type">Job Type:</label>
            <input type="text" name="job_type" id="job_type" class="form-control" value="{{ old('job_type', $lead->job_type) }}" required>
        </div>

        <div class="form-group">
            <label for="scheduled_at">Scheduled At:</label>
            <input type="datetime-local" name="scheduled_at" id="scheduled_at" class="form-control" 
            value="{{ old('scheduled_at', $lead->scheduled_at ? \Carbon\Carbon::parse($lead->scheduled_at)->format('Y-m-d\TH:i') : '') }}">
             </div>

        <div class="form-group">
            <label for="notes">Notes:</label>
            <textarea name="notes" id="notes" class="form-control">{{ old('notes', $lead->notes) }}</textarea>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control">
                <option value="new" {{ $lead->status == 'new' ? 'selected' : '' }}>New</option>
                <option value="contacted" {{ $lead->status == 'contacted' ? 'selected' : '' }}>Contacted</option>
                <option value="converted" {{ $lead->status == 'converted' ? 'selected' : '' }}>Converted</option>
                <option value="canceled" {{ $lead->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Lead</button>
        <a href="{{ route('admin.leads.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

@endsection
