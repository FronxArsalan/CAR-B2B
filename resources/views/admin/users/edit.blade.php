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
                            <h4 class="mb-4">Edit User</h4>
                                @include('message')
                            <form action="{{ route('user.update' , $user->id)  }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Full Name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter full name" value="{{ old('name' , $user->name) }}">
                                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <!-- Username -->
                                <div class="mb-3">
                                    <label for="user_name" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Enter username" value="{{ old('user_name' , $user->user_name) }}">
                                    @error('user_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ old('email' , $user->email) }}" readonly>
                                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <!-- Phone -->
                                <div class="mb-3">
                                    <label for="phone_no" class="form-label">Phone No</label>
                                    <input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="Enter phone number" value="{{ old('phone_no' , $user->phone_no) }}">
                                    @error('phone_no') <small class="text-danger">{{ $message }}</small> @enderror
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
