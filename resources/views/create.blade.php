<div class="container">
    <h2>Create New User</h2>
    <form id="multiStepForm" action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Step 1 -->
        <div id="step1" class="form-step">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>

            <button type="button" class="btn btn-secondary" id="nextStep">Next</button>
        </div>

        <!-- Step 2 -->
        <div id="step2" class="form-step" style="display: none;">
            <div class="form-group">
                <label for="profile_photo">Profile Photo</label>
                <input type="file" name="profile_photo" id="profile_photo" class="form-control">
            </div>

            <div class="form-group">
                <label for="department">Department</label>
                <input type="text" name="department" id="department" class="form-control" value="{{ old('department') }}" required>
            </div>

            <div class="form-group">
                <label for="position">Position</label>
                <input type="text" name="position" id="position" class="form-control" value="{{ old('position') }}" required>
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number') }}" required>
            </div>

            <div class="form-group">
                <label>Gender</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="Male" {{ old('gender') == 'Male' ? 'checked' : '' }}>
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="Female" {{ old('gender') == 'Female' ? 'checked' : '' }}>
                    <label class="form-check-label" for="female">Female</label>
                </div>
            </div>

            <button type="button" class="btn btn-secondary" id="prevStep">Previous</button>
            <button type="submit" class="btn btn-primary">Create User</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const nextStepButton = document.getElementById('nextStep');
        const prevStepButton = document.getElementById('prevStep');
        const step1 = document.getElementById('step1');
        const step2 = document.getElementById('step2');

        nextStepButton.addEventListener('click', function () {
            // Validasi semua field di langkah 1 sebelum melanjutkan
            if (validateStep1()) {
                step1.style.display = 'none';
                step2.style.display = 'block';
            }
        });

        prevStepButton.addEventListener('click', function () {
            step1.style.display = 'block';
            step2.style.display = 'none';
        });

        function validateStep1() {
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();
            const confirmPassword = document.getElementById('password_confirmation').value.trim();

            if (name === '' || email === '' || password === '' || confirmPassword === '') {
                alert('Please fill in all fields in Step 1.');
                return false;
            }

            if (password !== confirmPassword) {
                alert('Passwords do not match.');
                return false;
            }

            return true;
        }
    });
</script>
