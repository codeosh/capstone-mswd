// public\js\showalert.js
function showToast(message, type) {
    if ($('#toast-container').length === 0) {
        $('body').append(
            '<div id="toast-container" class="toast-container position-fixed bottom-0 end-0 p-3"></div>'
        );
    }
    const toast = $('<div>', {
        class: `toast text-bg-${type} show`,
        role: 'alert',
        'aria-live': 'assertive',
        'aria-atomic': 'true',
    });

    const toastHeader = $('<div>', {
        class: 'toast-header',
    });

    const toastTitle = $('<strong>', {
        class: 'me-auto',
        text: 'Notification',
    });

    const closeButton = $('<button>', {
        class: 'btn-close',
        type: 'button',
        'data-bs-dismiss': 'toast',
        'aria-label': 'Close',
    });

    toastHeader.append(toastTitle, closeButton);

    const toastBody = $('<div>', {
        class: 'toast-body',
        text: message,
    });

    toast.append(toastHeader, toastBody);

    $('#toast-container').append(toast);

    setTimeout(function () {
        toast.remove();
    }, 5000);
}
