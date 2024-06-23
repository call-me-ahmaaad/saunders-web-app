document.addEventListener('DOMContentLoaded', function() {
    const nextStepButton = document.getElementById('nextStep');
    const prevStepButton = document.getElementById('prevStep');
    const step1 = document.getElementById('step1');
    const step2 = document.getElementById('step2');

    nextStepButton.addEventListener('click', function() {
        // Validasi semua field di langkah 1 sebelum melanjutkan
        if (validateStep1()) {
            step1.style.display = 'none';
            step2.style.display = 'block';
        }
    });

    prevStepButton.addEventListener('click', function() {
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
