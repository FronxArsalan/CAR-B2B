@extends('include.dashboard-layout')

@section('dashboard-content')
    <style>
        .translate-middle-y {
            transform: translateY(18%) !important;
        }
    </style>

    <div class="content-page">
        <div class="content">
            <div class="container-fluid" style="margin-top: 30px;">
                <div class="row">
                    <div class="col-12">
                        <div class="card p-4">
                            <h4 class="mb-4">Add User</h4>
                            @include('message')
                            <form action="{{ route('user.store') }}" method="POST">
                                @csrf

                                <!-- Full Name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter full name" value="{{ old('name') }}">
                                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <!-- Username -->
                                <div class="mb-3">
                                    <label for="user_name" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Enter username" value="{{ old('user_name') }}">
                                    @error('user_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ old('email') }}">
                                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <!-- Phone -->
                                <div class="mb-3">
                                    <label for="phone_no" class="form-label">Phone No</label>
                                    <input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="Enter phone number" value="{{ old('phone_no') }}">
                                    @error('phone_no') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <!-- Password -->
                                <div class="mb-3 position-relative">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                                    <span class="position-absolute top-50 end-0 translate-middle-y me-3" onclick="togglePassword('password', 'toggleEye1')" style="cursor: pointer;">
                                        <i class="fas fa-eye" id="toggleEye1"></i>
                                    </span>
                                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="mb-3 position-relative">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm password">
                                    <span class="position-absolute top-50 end-0 translate-middle-y me-3" onclick="togglePassword('password_confirmation', 'toggleEye2')" style="cursor: pointer;">
                                        <i class="fas fa-eye" id="toggleEye2"></i>
                                    </span>
                                </div>

                                <!-- Submit -->
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Password Toggle Script -->
        <script>
            function togglePassword(inputId, iconId) {
                const input = document.getElementById(inputId);
                const icon = document.getElementById(iconId);

                if (input.type === "password") {
                    input.type = "text";
                    icon.classList.remove("fa-eye");
                    icon.classList.add("fa-eye-slash");
                } else {
                    input.type = "password";
                    icon.classList.remove("fa-eye-slash");
                    icon.classList.add("fa-eye");
                }
            }
        </script>
    </div>
@endsection
