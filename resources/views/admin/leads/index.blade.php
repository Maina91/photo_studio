@extends('layouts.admin')
@section('content')
@can('lead_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.leads.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.lead.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.lead.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        @include('flash::message')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Lead Name</th>
                <th>Client</th>
                <th>Job Type</th>
                <th>Scheduled At</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leads as $lead)
                <tr>
                    <td>{{ $lead->lead_name }}</td>
                    <td>{{ $lead->client ? $lead->client->name : 'N/A' }}</td>
                    <td>{{ $lead->job_type }}</td>
                    <td>{{ $lead->scheduled_at ? \Carbon\Carbon::parse($lead->scheduled_at)->format('Y-m-d H:i') : 'N/A' }}</td>
                    <td>{{ ucfirst($lead->status) }}</td>
                    <td>
                        <a href="{{ route('admin.leads.edit', $lead) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.leads.destroy', $lead) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection
