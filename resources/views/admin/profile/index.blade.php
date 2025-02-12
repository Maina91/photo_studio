@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">User Profile</div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @section('content')
    <div class="page">
        <div class="pageheader">
            <h2>My profile </h2>
            <div class="page-bar">
                <div id="datetime" class="pull-right"></div>
                <ul class="page-breadcrumb">
                    {{-- <li>
                        <a href="{{ url('home') }}"><i class="fa fa-home"></i> UnitMaster</a>
                    </li> --}}

                    <li>
                        <a href="{{ url('/profile/settings') }}">Settings/Profile</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="pagecontent">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- row -->
            <div class="row">
                <!-- col -->
                <div class="col-md-4">

                    <!-- tile -->
                    <section class="tile tile-simple">
                        @include('flash::message')
                        <!-- tile widget -->
                        <div class="tile-widget p-30 text-center">

                            <div class="thumb thumb-xl">
                                @if ($user->passport_photo == 'default.jpg')
                                    <img class="img-circle" src="{{ url('assets/images/default.jpg') }}" alt="">
                                @else
                                    <img class="img-circle" src="{{ asset('storage/avatar/' . $user->passport_photo) }}"
                                        alt="">
                                @endif
                            </div>
                            <h4 class="mb-0"><strong>{{ $user->name }}</strong> {{ $user->name }}</h4>
                            <div class="mt-10">
                                <button
                                    class="btn btn-rounded-40 btn-sm btn-greensea">{{ $user->name }}</button>
                            </div>
                        </div>
                        <!-- /tile widget -->

                        <!-- tile body -->
                        <div class="tile-body text-center bg-blue p-0">

                            <ul class="list-inline tbox m-0">
                                <li class="tcol p-10">
                                    <span class="text-transparent-white"><span class="text-muted">PF No</span>
                                        <h5 class="m-0 ">
                                            <p>{{ $user->pf_no }}</p>
                                        </h5>
                                </li>
                                <li class="tcol bg-blue dker p-10">
                                    <span class="text-transparent-white"><span class="text-muted">Identification No:</span>
                                        <h5 class="m-0">
                                            <p>{{ $user->id_no }}</p>
                                        </h5>
                                </li>
                                <li class="tcol p-10">
                                    <span class="text-transparent-white "><span class="text-muted">Date Of Birth:</span>
                                        <h5 class="m-0">
                                            <p>{{ $user->dob }}</p>
                                        </h5>
                                </li>
                            </ul>

                        </div>
                        <!-- /tile body -->

                    </section>
                    <!-- /tile -->
                    <!-- tile -->
                    <section class="tile tile-simple">

                        <!-- tile header -->
                        <div class="tile-header">
                            <h1 class="custom-font"><strong>About</strong> Me</h1>
                        </div>
                        <!-- /tile header -->

                        <!-- tile body -->
                        <div class="tile-body">

                            <p>
                                <a href="#" class="myIcon icon-info icon-ef-3 icon-ef-3b icon-color"><i
                                        class="fa fa-twitter"></i></a>
                                <a href="#" class="myIcon icon-primary icon-ef-3 icon-ef-3b icon-color"><i
                                        class="fa fa-linkedin"></i></a>
                                <a href="#" class="myIcon icon-lightred icon-ef-3 icon-ef-3b icon-color"><i
                                        class="fa fa-google-plus"></i></a>
                                {{-- <a href="#" class="myIcon icon-hotpink icon-ef-3 icon-ef-3b icon-color"><i
                                    class="fa fa-dribbble"></i></a> --}}
                            </p>


                            <div class="card tabs-dark" style="width: 18rem;">
                                <div class="card-header">
                                    Log in days
                                </div>
                                <ul class="list-group list-group-flush">
                                    {{-- @foreach ($log_in_days as $day)
                                        <li class="list-group-item">{{ $day }}</li>
                                    @endforeach --}}

                                </ul>
                            </div>



                        </div>
                        <!-- /tile body -->

                    </section>
                    <!-- /tile -->
                </div>
                <!-- /col -->
                <!-- col -->
                <div class="col-md-8">

                    <!-- tile -->
                    <section class="tile tile-simple">

                        <!-- tile body -->
                        <div class="tile-body p-0">

                            <div role="tabpanel">

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs tabs-dark" role="tablist">
                                    <li role="presentation" class="active"><a href="#settingsTab"
                                            aria-controls="settingsTab" role="tab" data-toggle="tab">Settings</a>
                                    </li>
                                    <li role="presentation"><a href="#feedTab" aria-controls="feedTab" role="tab"
                                            data-toggle="tab">Account Security</a></li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">

                                    <div role="tabpanel" class="tab-pane" id="feedTab">

                                        <div class="wrap-reset">

                                            <div class="streamline-form">
                                                <div class="row">
                                                    <div class="form-group col-md-12 legend">
                                                        <h4><strong>Security</strong> Settings</h4>
                                                        <p>Secure your account</p>
                                                        <div class="all_errors"></div>
                                                    </div>
                                                </div>
                                                <form class="profile-settings" method="post" action="" id="security">
                                                    {{ csrf_field() }}
                                                    <div class="row">

                                                        <div class="form-group col-sm-6">
                                                            <label for="username">Username</label>
                                                            <input type="text" class="form-control" id="username"
                                                                value="{{ $user->username }}" readonly>
                                                        </div>
                                                        <div class="form-group col-sm-6">
                                                            <label for="current_password">Current Password</label>
                                                            <input type="password" class="form-control"
                                                                id="current_password" name="current_password"
                                                                value="" required>

                                                        </div>
                                                    </div>

                                                    <div class="row">

                                                        <div class="form-group col-sm-6">
                                                            <label for="password">New Password</label>
                                                            <input type="password" class="form-control" id="password"
                                                                name="password" required>
                                                        </div>

                                                        <div class="form-group col-sm-6">
                                                            <label for="password_confirmation">New Password
                                                                Repeat</label>
                                                            <input type="password" class="form-control"
                                                                name="password_confirmation" id="password_confirmation"
                                                                required>
                                                        </div>

                                                    </div>
                                                    <hr class="line-full line-doted">
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-sm-offset-2 col-sm-10">
                                                                <button type="submit" id="password_button"
                                                                    class="btn btn-greensea b-0 text-uppercase pull-right">
                                                                    Change Password
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>

                                    </div>

                                    <div role="tabpanel" class="tab-pane active" id="settingsTab">

                                        <div class="wrap-reset">

                                            <form class="profile-settings" method="post" enctype="multipart/form-data"
                                                action="{{ url('/profile/update') }}" id="settings">
                                                {{ csrf_field() }}
                                                <input type="hidden" value="{{ $user->id }}" name="id"
                                                    id="id" />
                                                <div class="row">
                                                    <div class="form-group col-md-12 legend">
                                                        <h4><strong>Personal</strong> Settings</h4>
                                                        <p>Your personal account settings</p>
                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="form-group col-sm-6">
                                                        <label for="first_name">First Name</label>
                                                        <input type="text" class="form-control" name="first_name"
                                                            id="first_name" value="{{ $user->first_name }}">
                                                    </div>

                                                    <div class="form-group col-sm-6">
                                                        <label for="last_name">Last Name</label>
                                                        <input type="text" class="form-control" name="surname"
                                                            id="last_name" value="{{ $user->surname }}">
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-sm-6">
                                                        <label for="postal_address">Postal Address</label>
                                                        <input type="text" class="form-control" id="postal_address"
                                                            value="{{ $user->post_address }}" name="postal_address">
                                                    </div>

                                                    <div class="form-group col-sm-6">
                                                        <label for="physical_address">Physical Address</label>
                                                        <input type="text" class="form-control" id="physical_address"
                                                            value="{{ $user->physical_address }}"
                                                            name="physical_address">
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="form-group col-sm-4">
                                                        <label for="city">City</label>
                                                        <select id="city" name="city" class="chosen-select"
                                                            style="width: 90%;">
                                                            @foreach ($towns as $town)
                                                                @if ($town->id == $user->town)
                                                                    <option value="{{ $town->id }}" selected>
                                                                        {{ $town->name }}</option>
                                                                @else
                                                                    <option value="{{ $town->id }}">
                                                                        {{ $town->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-sm-4">
                                                        <label for="county">State/County</label>
                                                        <select id="county" name="county" class="chosen-select"
                                                            style="width: 90%;">
                                                            @foreach ($counties as $county)
                                                                @if ($county->id == $user->county)
                                                                    <option name="county" value="{{ $county->id }}"
                                                                        selected>
                                                                        {{ $county->county_name }}
                                                                    </option>
                                                                @else
                                                                    <option name="county" value="{{ $county->id }}">
                                                                        {{ $county->county_name }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-sm-4">
                                                        <label for="zip">Zip Code</label>
                                                        <input type="text" class="form-control" id="zip"
                                                            name="zip" value="{{ $user->zip }}">
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="form-group col-sm-6">
                                                        <label for="email">E-mail</label>
                                                        <input type="email" class="form-control" id="email"
                                                            value="{{ $user->email_address }}" readonly>
                                                    </div>

                                                    <div class="form-group col-sm-6">
                                                        <label for="country">Country</label>
                                                        <select id="country" name="country" class="chosen-select"
                                                            style="width: 90%;">
                                                            @foreach ($countries as $country)
                                                                @if ($country->id == $user->country)
                                                                    <option value="{{ $country->id }}" selected>
                                                                        {{ $country->name }}
                                                                    </option>
                                                                @else
                                                                    <option value="{{ $country->id }}">
                                                                        {{ $country->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="form-group col-sm-6">
                                                        <label for="phone">Phone</label>
                                                        <input type="text" class="form-control" id="phone"
                                                            name="phone" value="{{ $user->phone_no }}">
                                                        <span class="help-block">+(254) 999 999 999</span>
                                                    </div>

                                                    <div class="form-group col-sm-6">
                                                        <label for="avatar">Passport Photo</label>
                                                        <input type="file" onchange="readURL(this)" id="avatar"
                                                            name="avatar" class="filestyle" data-buttonText="Find file"
                                                            data-iconName="fa fa-inbox">
                                                        <input type="hidden" id="altlogo" name="altlogo"
                                                            value="default.jpg" />
                                                        <span class="help-block">Allowed files: gif, png, jpg. Max file
                                                            size
                                                            1Mb</span>
                                                    </div>

                                                </div>
                                                <hr class="line-full line-doted">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit"
                                                                class="btn btn-greensea b-0 text-uppercase pull-right">
                                                                Update My Account Settings
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>
                        <!-- /tile body -->

                    </section>
                    <!-- /tile -->

                </div>
                <!-- /col -->

            </div>
        </div>
    </div>
@endsection
       
    </div>
</div>
@endsection
