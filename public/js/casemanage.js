// public\js\casemanage.js
$(document).ready(function () {
    $(document).on('click', '.intake-button', function () {
        const beneficiaryId = $(this).data('id');
        window.location.href = `/Sub-page/Beneficiary/Intake-Form?beneficiaryID=${beneficiaryId}`;
    });

    $(document).on('click', '.interview-button', function () {
        const beneficiaryId = $(this).data('id');
        window.location.href = `/Sub-page/Beneficiary/Interview-Form?beneficiaryID=${beneficiaryId}`;
    });

    $('.radio_checkbox').on('change', function () {
        if ($(this).is(':checked')) {
            const group = $(this).data('group');
            $(`.radio_checkbox[data-group="${group}"]`)
                .not(this)
                .prop('checked', false);
        }
    });

    $('#inpatientCheckbox').change(function () {
        if ($(this).is(':checked')) {
            $('#inpatientOptions').stop().slideDown(300);
        } else {
            $('#inpatientOptions').stop().slideUp(300);
        }
    });

    $('#intakeNo').on('change', function () {
        if ($(this).prop('checked')) {
            $('#atInputDiv').hide();
        }
    });

    $('#intakeYes').on('change', function () {
        if ($(this).prop('checked')) {
            $('#atInputDiv').show();
        }
    });

    // For Family Composition Function
    $('#addRow').click(function (e) {
        e.preventDefault();
        const tableBody = document.getElementById('familyCompositionTable');
        const rowCount = tableBody.rows.length;
        var newRow = `<tr>
                        <td><input type="text" class="form-control" name="family[${rowCount}][relation]" placeholder="Relation to child"></td>
                        <td><input type="text" class="form-control" name="family[${rowCount}][name]" placeholder="Name"></td>
                        <td><input type="text" class="form-control" name="family[${rowCount}][lives_with_child]" placeholder="Lives w/ child?"></td>
                        <td><input type="text" class="form-control" name="family[${rowCount}][age_gender]" placeholder="Age/Gender?"></td>
                        <td><input type="text" class="form-control" name="family[${rowCount}][civil_status]" placeholder="Civil Status"></td>
                        <td><input type="text" class="form-control" name="family[${rowCount}][employed]" placeholder="Employed?"></td>
                        <td><input type="text" class="form-control" name="family[${rowCount}][occupation]" placeholder="Occupation"></td>
                        <td><input type="text" class="form-control" name="family[${rowCount}][education]" placeholder="Education"></td>
                        <td><input type="text" class="form-control" name="family[${rowCount}][weekly_income]" placeholder="Weekly Income"></td>
                        <td><input type="text" class="form-control" name="family[${rowCount}][school_company]" placeholder="School Company"></td>
                        <td><input type="text" class="form-control" name="family[${rowCount}][contact_info]" placeholder="Contact Information"></td>
                        </tr>`;
        $('#familyCompositionTable').append(newRow);
    });

    $('#removeRow').click(function (e) {
        e.preventDefault();
        var rows = $('#familyCompositionTable tr');
        if (rows.length > 1) {
            rows.last().remove();
        } else {
            showToast('At least one row must remain.', 'danger');
        }
    });

    function toggleInput(checkboxSelector, inputSelector) {
        $(checkboxSelector).on('change', function () {
            if ($(this).is(':checked')) {
                $(inputSelector).filter(':text').prop('disabled', true).val('');
            } else {
                $(inputSelector).filter(':text').prop('disabled', false);
            }
        });

        $(inputSelector)
            .filter(':text')
            .on('input', function () {
                if ($(this).val().trim() !== '') {
                    $(checkboxSelector).prop('disabled', true);
                } else {
                    $(checkboxSelector).prop('disabled', false);
                }
            });
    }

    toggleInput('#other_firstUnknown', 'input[name="other_firstAbuse"]');
    toggleInput('#most_unknown', 'input[name="other_recentIncident"]');

    // Other Incidents Functions
    $('#interview_siteofAbuseUnknown').change(function () {
        if ($(this).prop('checked')) {
            $(
                '#interview_siteofAbuseChildHome, #interview_siteofAbuseSchool, #interview_siteofAbusePerpetrators, #interview_siteofAbusePublicplace'
            ).prop('disabled', true);
        } else {
            $(
                '#interview_siteofAbuseChildHome, #interview_siteofAbuseSchool, #interview_siteofAbusePerpetrators, #interview_siteofAbusePublicplace'
            ).prop('disabled', false);
        }
    });
    $(
        '#interview_siteofAbuseChildHome, #interview_siteofAbuseSchool, #interview_siteofAbusePerpetrators, #interview_siteofAbusePublicplace'
    ).change(function () {
        if ($(this).prop('checked')) {
            $('#interview_siteofAbuseUnknown').prop('disabled', true);
        } else {
            if (
                $('#interview_siteofAbuseChildHome').prop('checked') ===
                    false &&
                $('#interview_siteofAbuseSchool').prop('checked') === false &&
                $('#interview_siteofAbusePerpetrators').prop('checked') ===
                    false &&
                $('#interview_siteofAbusePublicplace').prop('checked') === false
            ) {
                $('#interview_siteofAbuseUnknown').prop('disabled', false);
            }
        }
    });

    $('#intakeForm').on('submit', function (e) {
        e.preventDefault();

        const formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: '/Beneficiary/Case-Management/store',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (response) {
                if (response.success) {
                    showToast(response.message, 'success');
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            },
            error: function (xhr) {
                let errorMessage = 'An error occurred.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                showToast(errorMessage, 'danger');
            },
        });
    });

    $('#interviewForm').on('submit', function (e) {
        e.preventDefault();

        const formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: '/Beneficiary/Case-Management/Interview/store',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (response) {
                if (response.success) {
                    showToast(response.message, 'success');
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            },
            error: function (xhr) {
                let errorMessage = 'An error occurred.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                showToast(errorMessage, 'danger');
            },
        });
    });

    function calculateAge() {
        const birthdateInput = $('#birthdate').val();
        if (!birthdateInput) return;

        const birthdate = new Date(birthdateInput);
        const today = new Date();

        let age = today.getFullYear() - birthdate.getFullYear();
        const monthDifference = today.getMonth() - birthdate.getMonth();
        const dayDifference = today.getDate() - birthdate.getDate();

        if (
            monthDifference < 0 ||
            (monthDifference === 0 && dayDifference < 0)
        ) {
            age--;
        }

        $('#age').val(age >= 0 ? age : 0);
    }

    $('#birthdate').on('change', calculateAge);
    calculateAge();
});
