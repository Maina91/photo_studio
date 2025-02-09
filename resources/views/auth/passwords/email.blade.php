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
                    <form method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}
                        <h1>{{ trans('panel.site_title') }}</h1>
                        <p class="text-muted">{{ trans('global.forgot_password') }}</p>
                        <div>
                            <div class="form-group has-feedback">
                                <input type="email" name="email" class="form-control" required="autofocus" placeholder="{{ trans('global.login_email') }}">
                                @if($errors->has('email'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </em>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">
                                    {{ trans('global.reset_password') }}
                                </button>
                            </div>
                        </div>

                        <div class="row"> 
                            <div class="col-12">
                                <p class="">
                                    <a class="btn btn-link px-0  text-decoration-none"
                                     href="{{ route('login') }}">
                                        {{ trans('global.back_to_login') }}                                    </a>
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