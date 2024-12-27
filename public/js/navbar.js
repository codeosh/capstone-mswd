// public\js\navbar.js
$(document).ready(function () {
    // Toggle Sidebar
    $('#sidebarToggle').click(function () {
        $('.side-bar').toggleClass('collapsed');

        if ($('.side-bar').hasClass('collapsed')) {
            $('body').addClass('sidebar-collapsed');
            $('#dropServices').removeClass('show');
        } else {
            $('body').removeClass('sidebar-collapsed');
        }
    });

    // Toggle the dropdown menu
    $('#dropdownToggle').click(function (e) {
        e.preventDefault();
        var dropMenu = $('#dropServices');

        dropMenu.toggleClass('show');

        // Open the sidebar if it is collapsed
        if (dropMenu.hasClass('show') && $('.side-bar').hasClass('collapsed')) {
            $('.side-bar').removeClass('collapsed');
            $('body').removeClass('sidebar-collapsed');
        }
    });

    const activeItemKey = 'activeNavbarItem';
    if (!localStorage.getItem(activeItemKey)) {
        const dashboardHref = $('#dashboardLink').attr('href');
        localStorage.setItem(activeItemKey, dashboardHref);
    }
    const activeItem = localStorage.getItem(activeItemKey);
    if (activeItem) {
        $('.navbar-item').removeClass('active');
        $(`.navbar-item[href="${activeItem}"]`).addClass('active');
    }

    $('.navbar-item').on('click', function () {
        $('.navbar-item').removeClass('active');
        $(this).addClass('active');

        const href = $(this).attr('href');
        localStorage.setItem(activeItemKey, href);
    });

    $('#logoutButton').on('click', function () {
        localStorage.removeItem(activeItemKey);
    });
});
