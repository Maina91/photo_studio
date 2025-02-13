@extends('layouts.admin')
@section('content')
    <div class="page">
        <div class="pageheader">
            <h2 class="fw-bold text-dark">My <span class="text-primary">Profile</span></h2>
        </div>
        <div class="pagecontent">
            <div class="row">
                <div class="col-md-4">
                    <div class="tab-content">
                        <section class="tile tile-simple p-3">
                            @include('flash::message')
                            <div class="tile-widget p-3 text-center">
                                <div class="thumb thumb-xl mb-3">
                                    <div class="thumb thumb-xl">
                                        @if (empty($user->profile_photo))
                                            <img src="{{ url('assets/images/default.jpg') }}" 
                                                alt="User Image" 
                                                class="rounded-circle border shadow-sm img-fluid" 
                                                style="width: 100px; height: 100px; object-fit: cover;" />
                                        @else
                                            <img class="rounded-circle border shadow-sm img-fluid" 
                                                src="{{ asset('storage/avatar/' . $user->profile_photo) }}" 
                                                alt="User Image" 
                                                style="width: 100px; height: 100px; object-fit: cover;" />
                                        @endif
                                    </div>
                                <h4 class="mb-1 fw-bold">{{ $user->name }}</h4>
                                <button class="btn btn-success btn-sm rounded-pill shadow-sm px-2">
                                    {{ $user->name }}
                                </button>
                            </div>
                        </section>

                        <section class="tile tile-simple p-3">
                            <div class="tile-header">
                                <h3 class="fw-bold text-dark">About <span class="text-primary">Me</span></h3>
                            </div>

                            <div class="tile-body">
                                <div class="d-flex justify-content-center mt-2">
                                    <a href="#" class="btn btn-outline-info btn-lg rounded-circle d-flex align-items-center justify-content-center shadow-sm mx-2"
                                        style="width: 50px; height: 50px;">
                                        <i class="fab fa-twitter fa-2x"></i>
                                    </a>
                                    <a href="#" class="btn btn-outline-primary btn-lg rounded-circle d-flex align-items-center justify-content-center shadow-sm mx-2"
                                        style="width: 50px; height: 50px;">
                                        <i class="fab fa-linkedin-in fa-2x"></i>
                                    </a>
                                    <a href="#" class="btn btn-outline-danger btn-lg rounded-circle d-flex align-items-center justify-content-center shadow-sm mx-2"
                                        style="width: 50px; height: 50px;">
                                        <i class="fab fa-google-plus-g fa-2x"></i>
                                    </a>
                                </div>                            
                
                                <div class="card mt-3" style="width: 20rem;">
                                    <div class="card-header">
                                        Log in days
                                    </div>
                                    <ul class="list-group list-group-flush">
                                         @foreach ($user->login_days ?? [] as $day)
                                            <li class="list-group-item">{{ $day }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                
                <div class="col-md-8">
                    <section class="tile tile-simple">
                        <div class="tile-body p-0">
                            <div role="tabpanel">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist" style="background-color: #0A192F;">
                                    <li role="presentation" class="active nav-item">
                                        <a class="nav-link active text-decoration-none" 
                                        href="#settingsTab" aria-controls="settingsTab" role="tab" data-toggle="tab">Settings</a>
                                    </li>
                                    <li role="presentation" class="nav-item">
                                        <a class="nav-link text-decoration-none" 
                                        href="#feedTab" aria-controls="feedTab" role="tab" data-toggle="tab">Account Security</a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane" id="feedTab">
                                        <div class="wrap-reset">
                                            <div class="streamline-form">
                                                <div class="row mb-2">
                                                    <div class="col-md-12 ">
                                                        <h4 class="fw-bold text-primary"><strong>Security</strong> Settings</h4>
                                                        <p class="text-muted mb-0">Secure your account</p>
                                                        <hr class="line-full line-doted">
                                                    </div>
                                                </div>
                                                <form class="profile-settings" method="post"
                                                 {{-- action="{{ route('admin.profile.changePassword') }}" --}}
                                                  id="security">
                                                    {{ csrf_field() }}
                                                    <div class="row">
                                                        <div class="form-group col-sm-6">
                                                            <label for="username">Username</label>
                                                            <input type="text" class="form-control" id="username"
                                                                   value="{{ $user->name }}" readonly>
                                                        </div>
                                                        <div class="form-group col-sm-6">
                                                            <label for="current_password">Current Password</label>
                                                            <div class="input-group">
                                                                <input type="password" class="form-control" id="current_password" name="current_password" required>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text toggle-password" data-target="current_password" style="cursor: pointer;">
                                                                        <i class="fa fa-eye"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="form-group col-sm-6">
                                                            <label for="password">New Password</label>
                                                            <div class="input-group">
                                                                <input type="password" class="form-control" id="password" name="password" required>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text toggle-password" data-target="password" style="cursor: pointer;">
                                                                        <i class="fa fa-eye"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-sm-6">
                                                            <label for="password_confirmation">New Password Repeat</label>
                                                            <div class="input-group">
                                                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text toggle-password" data-target="password_confirmation" style="cursor: pointer;">
                                                                        <i class="fa fa-eye"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <hr class="line-full line-doted">
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-sm-offset-2 col-sm-10">
                                                                <button  id="password_button" class="btn btn-primary">
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
                                                action="{{ route('admin.profile.update') }}" id="settings">
                                                {{ csrf_field() }}
                                                <input type="hidden" value="{{ $user->id }}" name="id"
                                                    id="id" />
                                                <div class="row mb-2">
                                                    <div class="col-md-12 ">
                                                        <h4 class="fw-bold text-primary"><strong>Profile</strong> Settings</h4>
                                                        <p class="text-muted mb-0">Your personal account settings</p>
                                                        <hr class="line-full line-doted">
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
                                                        <label for="country">Country</label>
                                                        <select id="country" name="country" class="form-select"
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
                                                    <div class="form-group col-sm-4">
                                                        <label for="county">County</label>
                                                        <select id="county" name="county" class="chosen-select"
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
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-sm-6">
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control" id="email"
                                                            value="{{ $user->email }}" readonly>
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="zip">Zip Code</label>
                                                        <input type="text" class="form-control" id="zip"
                                                            name="zip" value="{{ $user->zip }}">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label for="phone" class="form-label">Phone</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">+254</span>
                                                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone_no }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="avatar" class="form-label">Passport Photo</label>
                                                        
                                                        <div class="input-group">
                                                            <input type="file" class="form-control" id="avatar" name="avatar" 
                                                                accept=".gif, .png, .jpg, .jpeg" onchange="readURL(this)">
                                                        </div>
                                                    
                                                        <input type="hidden" id="altlogo" name="altlogo" value="default.jpg">
                                                        
                                                        <small class="form-text text-muted">
                                                            Allowed files: GIF, PNG, JPG. Max file size: <strong>1MB</strong>.
                                                        </small>
                                                    </div>
                                                </div>

                                                <hr class="line-full line-doted">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit"
                                                                class="btn btn-primary">
                                                                Update Account Profile
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
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
       
@section('scripts')
<script>
    $(document).ready(function() {
        $("#password_button").click(function(event) {
            event.preventDefault(); 
    
            let form = $("#security")[0]; 
            let formData = new FormData(form);
            const url = "{{ route('admin.profile.changePassword') }}";
            const auth_token = "{{ csrf_token() }}";
            console.log(auth_token);
    
            $.ajax({
                url: url,
                method: "POST",
                data: formData,
                processData: false, 
                contentType: false,
                headers: {
                        "auth-token": auth_token,
                    },
                success: function(response) {
                    if (response.status === "success") {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: response.message
                        }).then(() => {
                            window.location.href = response.route;
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: response.message
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Something went wrong. Please try again."
                    });
                }
            });
        });
    
        // Toggle password visibility
        $(".toggle-password").click(function() {
            let target = $(this).data("target");
            let input = $("#" + target);
            if (input.attr("type") === "password") {
                input.attr("type", "text");
                $(this).find("i").removeClass("fa-eye").addClass("fa-eye-slash");
            } else {
                input.attr("type", "password");
                $(this).find("i").removeClass("fa-eye-slash").addClass("fa-eye");
            }
        });
    });
    </script>
    
@endsection
