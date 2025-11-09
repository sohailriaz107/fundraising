@extends('layouts.app')
@section('title', 'profile')
@section('content')

<style>
    .list-group-item.active {
        background-color: green !important;
        color: black !important;
        /* readable text */
    }
</style>
<div class="block-31" style="position: relative;">
    <div class="owl-carousel loop-block-31 ">
        <div class="block-30 block-30-sm item" style="background-image: url('{{ asset('assets/images/bg_1.jpg') }}');" data-stellar-background-ratio="0.5">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7 text-center">
                        <h2 class="heading">Be Hope for others</h2>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="site-section mb-5">
    <div class="container">
        <h1 class="mb-4">Profile Settings</h1>
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 mb-4">


                <div class="list-group" id="sidebar-menu">
                    <a href="#profile-info" class="list-group-item list-group-item-action active">Profile Info</a>
                    <a href="#change-password" class="list-group-item list-group-item-action">Change Password</a>
                    <a href="#donation" class="list-group-item list-group-item-action">Donation</a>
                    <a href="#" class="list-group-item list-group-item-action"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>



            </div>

            <!-- Main content -->
            <div class="col-md-9">
                <!-- Profile Info -->
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}

                </div>
                @endif

                @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}

                </div>
                @endif
                <div id="profile-info" class="card mb-4">


                    <div class="card-body">
                        <h5 class="card-title text-center">Profile Information</h5>
                        <form action="{{route('profile.update')}}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="mb-3 text-center">
                                <!-- Image Preview -->
                                <div style="position: relative; display: inline-block;">
                                    <img id="profilePreview"
                                        src="{{ $user->image ? asset($user->image) : '' }}"
                                        alt="profile image"
                                        class="rounded-circle"
                                        width="150" height="150"
                                        style="object-fit: cover; border: 2px solid #ddd;">

                                    <!-- + Icon Button -->
                                    <label for="profile_image"
                                        style="position: absolute; bottom: 0; right: 0; background: #007bff; color: white; 
                      width: 40px; height: 40px; border-radius: 50%; display: flex; 
                      align-items: center; justify-content: center; cursor: pointer; font-size: 24px;">
                                        +
                                    </label>
                                </div>

                                <!-- Hidden File Input -->
                                <input type="file" id="profile_image" name="image" accept="image/*" style="display: none;">
                            </div>

                            <script>
                                const profileImage = document.getElementById('profile_image');
                                const profilePreview = document.getElementById('profilePreview');

                                profileImage.addEventListener('change', function(event) {
                                    const [file] = profileImage.files;
                                    if (file) {
                                        profilePreview.src = URL.createObjectURL(file);
                                    }
                                });
                            </script>


                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" value="{{$user->name}}">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Addres</label>
                                <input type="address" class="form-control" id="address" name="address" placeholder="Enter your Address" value="{{$user->address ??'not added yet'}}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="{{$user->email}}">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter your phone" value="{{$user->phone ?? 'no added yet'}}">
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>

                    </div>
                </div>

                <!-- Change Password -->

                <div id="change-password" class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Change Password</h5>
                        <form action="{{ route('password.update') }}" method="post">
                            @method('PUT')
                            @csrf

                            <div class="mb-3">
                                <label for="current-password" class="form-label">Current Password</label>
                                <input type="password" class="form-control" id="current-password" name="current_password" required>
                                @error('current_password')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="new-password" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="new-password" name="password" required>
                                @error('password')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="confirm-password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm-password" name="password_confirmation" required>
                            </div>

                            <button type="submit" class="btn btn-warning">Update Password</button>
                        </form>

                    </div>
                </div>

                <!-- Notifications -->

                <h3 id="donation">Your Donations</h3>

                @if($user->donations->count() > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Campaign</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user->donations as $donation)
                        <tr>
                            <td>{{ $donation->id }}</td>
                            <td>{{ $donation->amount }}</td>
                            <td>{{ $donation->created_at->format('d M Y') }}</td>
                            <td>{{ $donation->campaign->campaign_name ?? 'N/A' }}</td> <!-- if donation belongs to a campaign -->
                            <td>
                                <img src="{{$donation->campaign->image ?? 'N/A'}}" alt="" width="100px" height="100px" class="rounded-circle">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p>You haven’t made any donations yet.</p>
                @endif


            </div>
        </div>
    </div>
</div>

<script>
    // Select all clickable list items except Logout
    const menuItems = document.querySelectorAll('#sidebar-menu a.list-group-item-action:not([onclick])');

    menuItems.forEach(item => {
        item.addEventListener('click', function() {
            // Remove active class from all items
            menuItems.forEach(i => i.classList.remove('active'));

            // Add active class to clicked item
            this.classList.add('active');
        });
    });
</script>

<!-- .site-section -->
@endsection