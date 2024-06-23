@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="{{ URL::asset('/css/profile.css') }}">
@endsection
@section('javascript')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
@section('wrapper')
<div class="profile card">
    <div class="avatar">
        @php
            $defaultPhoto = 'images/default_profile.png';
            if (Auth::user()->gender == 'Male') {
                $defaultPhoto = 'images/user_profile/Default Male Photo Profile.jpg';
            } elseif (Auth::user()->gender == 'Female') {
                $defaultPhoto = 'images/user_profile/Default Female Photo Profile.jpg';
            }
        @endphp
        <img src="{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : asset($defaultPhoto) }}"
            alt="User Profile" height="170px">
        <h3 class="name">{{ Auth::user()->name }}</h3>
    </div>
    <div class="detail">
        <p class="departement">{{ Auth::user()->department }} Departement</p>
        <p class="position">{{ Auth::user()->position }}</p>
        <p class="email">{{ Auth::user()->email }}</p>
        <p class="phone_number">{{ \App\Helpers\PhoneNumberHelper::format(Auth::user()->phone_number) }}</p>
    </div>
    <div class="change">
        <a href="#" id="changePasswordBtn">Change Password</a>
        <a href="#" id="changeAvatarBtn">Change Avatar</a>
    </div>
</div>

<!-- Pop up form for changing password -->
<div class="popup" id="passwordPopup">
    <div class="popup-content">
        <span class="close-btn" id="closePasswordPopup">&times;</span>
        <h2>Change Password</h2>
        <form method="post" action="{{ route('password.update') }}">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="update_password_current_password" :value="__('Current Password')">Current
                    Password</label>
                <input id="update_password_current_password" name="current_password" type="password"
                    autocomplete="current-password">
            </div>
            <div class="form-group">
                <label for="update_password_password" :value="__('New Password')">New Password</label>
                <input id="update_password_password" name="password" type="password" autocomplete="new-password">
            </div>
            <div class="form-group">
                <label for="update_password_password_confirmation" :value="__('Confirm Password')">Confirm New
                    Password</label>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                    autocomplete="new-password">
            </div>
            <button type="submit">Change Password</button>
        </form>
    </div>
</div>

<!-- Pop up form for changing avatar -->
<div class="popup" id="avatarPopup">
    <div class="popup-content">
        <span class="close-btn" id="closeAvatarPopup">&times;</span>
        <h2>Change Avatar</h2>
        @php
            if (Auth::user()->gender == 'Male') {
                $defaultPhoto = 'images/user_profile/Default Male Photo Profile.jpg';
            } elseif (Auth::user()->gender == 'Female') {
                $defaultPhoto = 'images/user_profile/Default Female Photo Profile.jpg';
            }
        @endphp
        <img src="{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : asset($defaultPhoto) }}"
            alt="User Profile" height="100px">
            <form id="changeAvatarForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="form-group">
                    <label for="profile_photo">New Avatar</label>
                    <input type="file" id="profile_photo" name="profile_photo" required>
                </div>
                <button type="submit">Change Avatar</button>
            </form>

        <form id="deleteAvatarForm" action="{{ route('profile.delete-avatar') }}" method="POST">
            @csrf
            <button type="submit">Delete Avatar</button>
        </form>
    </div>

    <script src="{{ URL::asset('/javascript/profile/popUpForm.js') }}"></script>
</div>
@endsection
