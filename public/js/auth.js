// public\js\auth.js
$.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
});
$(document).ready(function () {
    $(document).on('click', '#logoutForm button', function (e) {
        e.stopPropagation();
    });
    $('#loginForm').on('submit', function (e) {
        e.preventDefault();

        const email = $('#emailInput').val();
        const password = $('#passwordInput').val();

        const loginButton = $(this).find("button[type='submit']");
        loginButton.prop('disabled', true).text('Logging in...');

        $.ajax({
            url: '/MSWDO/Login',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                email: email,
                password: password,
            },
            success: function (response) {
                if (response.success) {
                    showToast('Login successful!', 'success');
                    setTimeout(() => {
                        window.location.href = response.redirect;
                    }, 1000);
                } else {
                    loginButton.prop('disabled', false).text('Login');
                    showToast(response.message, response.alert_type);
                }
            },
            error: function (xhr) {
                loginButton.prop('disabled', false).text('Login');
                if (xhr.status === 401) {
                    showToast('Invalid credentials', 'danger');
                } else {
                    showToast('An error occurred', 'danger');
                }
            },
        });
    });

    $('#showPassword').on('change', function () {
        const passwordField = $('#passwordInput');
        if ($(this).is(':checked')) {
            passwordField.attr('type', 'text');
        } else {
            passwordField.attr('type', 'password');
        }
    });

    // Function to show toast messages
    function showToast(message, alertType) {
        let toastHTML = `
        <div class="toast text-white z-1 bg-${alertType} border-0 position-fixed top-0 end-0 m-3" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Notification</strong>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                ${message}
            </div>
        </div>
    `;
        $('#toast-container').append(toastHTML);

        var toastElement = $('.toast');
        var toast = new bootstrap.Toast(toastElement[toastElement.length - 1]);
        toast.show();

        setTimeout(() => {
            toastElement.remove();
        }, 3000);
    }
});
