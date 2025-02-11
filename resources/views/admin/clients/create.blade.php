@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.client.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.clients.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.client.fields.name') }}</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($client) ? $client->name : '') }}">
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.client.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                <label for="phone">{{ trans('cruds.client.fields.phone') }}</label>
                <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', isset($client) ? $client->phone : '') }}">
                @if($errors->has('phone'))
                    <em class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.client.fields.phone_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">{{ trans('cruds.client.fields.email') }}</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($client) ? $client->email : '') }}">
                @if($errors->has('email'))
                    <em class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.client.fields.email_helper') }}
                </p>
            </div>
            <div class="form-group">
                <label for="lead_source_id">How did you hear about us?</label>
                <select name="lead_source_id" id="lead_source_id" class="form-control">
                    <option value="">Select Lead Source</option>
                    @foreach($leadSources as $source)
                        <option value="{{ $source->id }}" 
                            data-referral="{{ strtolower($source->name) == 'referral' ? 'yes' : 'no' }}"
                            {{ old('lead_source_id', $client->lead_source_id ?? '') == $source->id ? 'selected' : '' }}>
                            {{ $source->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group {{ $errors->has('referred_by') ? 'has-error' : '' }}" id="referred_by_group" style="display: none;">
                <label for="referred_by">Referred By</label>
                <select id="referred_by" name="referred_by" class="form-control">
                    <option value="">-- Select Referrer --</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ old('referred_by', $client->referred_by ?? '') == $client->id ? 'selected' : '' }}>
                            {{ $client->name }}
                        </option>
                    @endforeach
                </select>
                @if($errors->has('referred_by'))
                    <em class="invalid-feedback">
                        {{ $errors->first('referred_by') }}
                    </em>
                @endif
            </div>
            
            
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let leadSourceSelect = document.getElementById('lead_source_id');
        let referredByGroup = document.getElementById('referred_by_group');
    
        function toggleReferredBy() {
            let selectedOption = leadSourceSelect.options[leadSourceSelect.selectedIndex];
            let isReferral = selectedOption.getAttribute('data-referral') === 'yes';
    
            referredByGroup.style.display = isReferral ? 'block' : 'none';
        }
    
        // Run on page load in case of validation errors
        toggleReferredBy();
    
        // Listen for changes
        leadSourceSelect.addEventListener('change', toggleReferredBy);
    });
    </script>
    
@endsection