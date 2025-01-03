// public\js\filterAnalytics.js
$(document).ready(function () {
    // Populate months
    const months = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December',
    ];
    months.forEach(function (month, index) {
        $('#selectMonthFilter').append(new Option(month, index + 1));
    });

    const currentYear = new Date().getFullYear();

    for (let year = currentYear; year >= 2020; year--) {
        $('#selectYearFilter').append(new Option(year, year));
    }

    // Function to toggle disable state based on selected filters
    function toggleDateFilters() {
        const monthSelected = $('#selectMonthFilter').val();
        const yearSelected = $('#selectYearFilter').val();
        const startDateSelected = $('#filterMapStartDate').val();
        const endDateSelected = $('#filterMapEndDate').val();

        if (monthSelected || yearSelected) {
            $('#filterMapStartDate').prop('disabled', true);
            $('#filterMapEndDate').prop('disabled', true);
        } else if (startDateSelected || endDateSelected) {
            $('#selectMonthFilter').prop('disabled', true);
            $('#selectYearFilter').prop('disabled', true);
        } else {
            $('#filterMapStartDate').prop('disabled', false);
            $('#filterMapEndDate').prop('disabled', false);
            $('#selectMonthFilter').prop('disabled', false);
            $('#selectYearFilter').prop('disabled', false);
        }
    }

    toggleDateFilters();

    $('#selectMonthFilter, #selectYearFilter').on('change', function () {
        toggleDateFilters();
    });

    $('#filterMapStartDate, #filterMapEndDate').on('change', function () {
        toggleDateFilters();
    });

    $('#clearFilterMapButton').on('click', function () {
        $('#selectMapFilterType').val('');
        $('#selectMonthFilter').val('');
        $('#selectYearFilter').val('');
        $('#filterMapStartDate').val('');
        $('#filterMapEndDate').val('');

        toggleDateFilters();
    });
});
