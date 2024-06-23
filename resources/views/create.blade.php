@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="{{URL::asset("/css/create.css")}}">
@endsection
@section('wrapper')
    <form id="multiStepForm" action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h2>Create New User</h2>
        <!-- Step 1 -->
        <div id="step1" class="form-step">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                    required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"
                    required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                    required>
            </div>

            <button type="button" class="btn btn-secondary" id="nextStep">Next</button>
        </div>

        <!-- Step 2 -->
        <div id="step2" class="form-step" style="display: none;">
            <div class="form-group">
                <label for="department">Department</label>
                <select name="department" id="department" class="form-control" required>
                    <option value="">Select Department</option>
                    <option value="Human Resource" {{ old('department') == 'Human Resource' ? 'selected' : '' }}>Human
                        Resource</option>
                    <option value="Purchasing" {{ old('department') == 'Purchasing' ? 'selected' : '' }}>Purchasing</option>
                    <option value="Engineering" {{ old('department') == 'Engineering' ? 'selected' : '' }}>Engineering
                    </option>
                    <option value="Accounting" {{ old('department') == 'Accounting' ? 'selected' : '' }}>Accounting</option>
                </select>
            </div>

            <div class="form-group">
                <label for="position">Position</label>
                <select name="position" id="position" class="form-control" required>
                    <option value="">Select Position</option>
                    <option value="Manager" {{ old('position') == 'Manager' ? 'selected' : '' }}>Manager</option>
                    <option value="Staff" {{ old('position') == 'Staff' ? 'selected' : '' }}>Staff</option>
                    <option value="Operator" {{ old('position') == 'Operator' ? 'selected' : '' }}>Operator</option>
                </select>
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control"
                    value="{{ old('phone_number') }}" required>
            </div>

            <div class="form-group gender">
                <label>Gender</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="Male"
                        {{ old('gender') == 'Male' ? 'checked' : '' }}>
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="Female"
                        {{ old('gender') == 'Female' ? 'checked' : '' }}>
                    <label class="form-check-label" for="female">Female</label>
                </div>
            </div>

            <button type="button" class="btn btn-secondary" id="prevStep">Previous</button>
            <button type="submit" class="btn btn-primary">Create User</button>
        </div>
    </form>

    <script src="{{ URL::asset('/javascript/create/stepForm.js') }}"></script>
@endsection
