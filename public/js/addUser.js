$(document).ready(function () {
    $('#addUserModal').on('click', function () {
        $('#addUserModal').modal('show'); // Correctly invoke the modal
    });
});

//Show Password
document.addEventListener('DOMContentLoaded', function () {
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    const toggleConfirmPassword = document.getElementById(
        'toggleConfirmPassword'
    );
    const confirmPassword = document.getElementById('confirmPassword');

    togglePassword.addEventListener('click', function () {
        const type =
            password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });

    toggleConfirmPassword.addEventListener('click', function () {
        const type =
            confirmPassword.getAttribute('type') === 'password'
                ? 'text'
                : 'password';
        confirmPassword.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
});
