@extends('layouts.admin')
@section('content')
@can('payment_schedule_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.payment_schedule.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.payment_schedule.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.payment_schedule.title_singular') }} {{ trans('global.list') }}
        
    </div>

    <div class="card-body">
        @include('flash::message')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Initial Payment (%)</th>
                <th>Remaining Payment (Days)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schedules as $schedule)
                <tr>
                    <td>{{ $schedule->name }}</td>
                    <td>{{ $schedule->initial_payment_percentage }}%</td>
                    <td>{{ $schedule->remaining_payment_days }} days</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection
