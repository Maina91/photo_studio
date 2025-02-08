@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card-group">
            <div class="card p-4">
                <div class="card-body">
                    @if(\Session::has('message'))
                        <p class="alert alert-info">
                            {{ \Session::get('message') }}
                        </p>
                    @endif
                    @include('flash::message')
                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <h1>{{ trans('panel.site_title') }}</h1>
                        <p class="text-muted">{{ trans('global.login') }}</p>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-user"></i>
                                </span>
                            </div>
                            <input name="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="password" class="form-label mb-0">{{ __('Password') }}</label>
                                <a class="btn btn-link px-0 text-decoration-none"
                                 href="{{ route('password.request') }}">
                                    {{ trans('global.forgot_password') }}
                                </a>
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                </div>
                                <input name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" 
                                       required placeholder="{{ trans('global.login_password') }}">
                                @if($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        

                        <div class="input-group mb-4">
                            <div class="form-check checkbox">
                                <input class="form-check-input" name="remember" type="checkbox" id="remember" style="vertical-align: middle;" />
                                <label class="form-check-label" for="remember" style="vertical-align: middle;">
                                    {{ trans('global.remember_me') }}
                                </label>
                            </div>
                        </div>

                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary px-4 w-100">
                                    {{ trans('global.login') }}
                                </button>
                        </div>

                        <div class="row"> 
                            <div class="col-12 ">
                                <p class="">Don't have any account? 
                                    <a class="btn btn-link px-0" href="{{ route('register') }}">
                                        {{ trans('global.sign_up') }}
                                    </a>
                                </p>
                            </div>
                        </div>
                        

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection