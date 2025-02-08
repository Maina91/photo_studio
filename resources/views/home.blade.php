@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            @include('flash::message')
            Welcome
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection