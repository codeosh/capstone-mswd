// public\js\beneficiarypage.js
$(document).ready(function () {
    const $serviceTypeSelect = $('#serviceTypeSelect');
    const $statusSelect = $('#status');
    const $childCasesSection = $('.child-cases-section');
    const $childCasesInputs = $childCasesSection.find(
        'input, select, textarea'
    );

    function toggleChildCasesSection() {
        const selectedServiceType = $serviceTypeSelect.val();
        const selectedStatus = $statusSelect.val();

        if (
            (selectedServiceType === 'CAR' || selectedServiceType === 'CICL') &&
            selectedStatus === 'Child or Youth'
        ) {
            $childCasesSection.removeClass('d-none');
            $childCasesInputs.attr('required', true);
        } else {
            $childCasesSection.addClass('d-none');
            $childCasesInputs.removeAttr('required');
            $childCasesInputs.val('');
        }
    }

    $serviceTypeSelect.on('change', toggleChildCasesSection);
    $statusSelect.on('change', toggleChildCasesSection);

    $('#addBeneficiaryForm').on('submit', function (e) {
        e.preventDefault();

        const formData = $(this).serialize();

        $.ajax({
            url: '/Beneficiary/store',
            type: 'POST',
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

    $('#birthdate').on('change', function () {
        const birthdateInput = $(this).val();
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

        $('#childAge').val(age >= 0 ? age : 0);
    });

    // --------------------------------------------------------------------------------------- //
    // Profile Modal Functions
    $('#editProfileBtn').on('click', function () {
        const fieldsToToggle = [
            '#profileFirstname',
            '#profileMiddlename',
            '#profileLastname',
            '#profileSuffix',
            '#profileSex',
            '#profileBirthdate',
            '#profileCategory',
            '#profileStreetname',
            '#profileBarangay',
            '#profileRemarks',
        ];

        fieldsToToggle.forEach((selector) => {
            const input = $(selector);
            input.prop('readonly', !input.prop('readonly'));
            input.toggleClass('bg-light border-primary');
        });

        $('#editNote').removeClass('d-none');

        // Toggle buttons
        $(this).addClass('d-none');
        $('#saveProfileBtn').removeClass('d-none');
    });

    // Reset fields when modal is closed
    $('#profileBeneficiaryModal').on('hidden.bs.modal', function () {
        const fieldsToToggle = [
            '#profileFirstname',
            '#profileMiddlename',
            '#profileLastname',
            '#profileSuffix',
            '#profileSex',
            '#profileBirthdate',
            '#profileCategory',
            '#profileStreetname',
            '#profileBarangay',
            '#profileRemarks',
        ];
        fieldsToToggle.forEach((selector) => {
            const input = $(selector);
            input.prop('readonly', true).removeClass('bg-light border-primary');
        });

        $('#editNote').addClass('d-none');
        $('#editProfileBtn').removeClass('d-none');
        $('#saveProfileBtn').addClass('d-none');
    });
    // End of Profile Beneficiary Modal

    $('#profileBeneficiaryForm').on('submit', function (e) {
        e.preventDefault();

        const formData = $(this).serialize();
        const beneficiaryId = $('#profileBeneficiaryId').val();

        $.ajax({
            url: `/Beneficiary/update/${beneficiaryId}`,
            type: 'PUT',
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

    // --------------------------------------------------------------------------------------- //
    // Service Modal Functions

    $('.dropdown-item').on('click', function (e) {
        e.preventDefault();
        const selectedValue = $(this).data('value');
        const selectedText = $(this).text().trim();

        $('#dropdownMenuButton').text(selectedText);
        $('#selectedService').val(selectedValue);
    });

    $('#dropdownSearch').on('keyup', function () {
        const searchTerm = $(this).val().toLowerCase();
        const searchWords = searchTerm.split(/\s+/);

        $('.dropdown-item').each(function () {
            const itemText = $(this).text().toLowerCase();
            const matches = searchWords.every((word) =>
                itemText.includes(word)
            );
            if (matches) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    $('#serviceBeneficiaryModal').on('hidden.bs.modal', function () {
        $(this).find('#dropdownMenuButton').text('Select Service');
        $(this).find('input[type="radio"]').prop('checked', false);
    });

    $('#addServiceForm').on('submit', function (e) {
        e.preventDefault();

        const formData = $(this).serialize();

        $.ajax({
            url: '/Beneficiary/add-service',
            type: 'POST',
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
                } else {
                    showToast(response.message, 'danger');
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

    // --------------------------------------------------------------------------------------- //
    // History Modal Functions

    // Handle filter button click
    $('#filterButton').on('click', function () {
        const serviceType = $('#serviceTypeSelect').val();
        const startDate = $('#serviceStartDate').val();
        const endDate = $('#serviceEndDate').val();
        filterServices(serviceType, startDate, endDate);
    });

    // Filter services based on selected criteria
    function filterServices(serviceType, startDate, endDate) {
        const tableBody = $('#historyBeneficiaryTable');
        tableBody.html(
            '<tr><td colspan="5" class="text-center">Loading...</td></tr>'
        );

        const beneficiaryId = $('#historyBeneficiaryId').val();
        if (!beneficiaryId) {
            tableBody.html(
                '<tr><td colspan="5" class="text-danger text-center">Invalid Beneficiary</td></tr>'
            );
            return;
        }

        $.ajax({
            url: `/Beneficiaries/${beneficiaryId}/filtered-services`,
            type: 'GET',
            data: { serviceType, startDate, endDate },
            success: function (response) {
                if (response.success) {
                    populateTable(response.data.services);
                } else {
                    tableBody.html(
                        '<tr><td colspan="5" class="text-danger text-center">Failed to load services.</td></tr>'
                    );
                }
            },
            error: function () {
                tableBody.html(
                    '<tr><td colspan="5" class="text-danger text-center">An error occurred.</td></tr>'
                );
            },
        });
    }

    // Populate the services table
    function populateTable(services) {
        const tableBody = $('#historyBeneficiaryTable');
        if (services.length > 0) {
            const rows = services
                .sort((a, b) => new Date(b.created_at) - new Date(a.created_at))
                .map((service) => {
                    const dueDate = service.due_date
                        ? new Date(service.due_date).toLocaleDateString(
                              'en-US',
                              { month: 'long', day: '2-digit', year: 'numeric' }
                          )
                        : 'No Exp Date';

                    const createdAt = new Date(
                        service.created_at
                    ).toLocaleDateString('en-US', {
                        month: 'long',
                        day: '2-digit',
                        year: 'numeric',
                    });
                    const createdAtTime = new Intl.DateTimeFormat('en-US', {
                        timeZone: 'Asia/Manila',
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: true,
                    }).format(new Date(service.created_at));

                    const serviceAvailed = service.service_availed
                        ? service.service_availed
                        : 'Null';

                    return `
                    <tr>
                        <td>${service.service_name}</td>
                        <td>${serviceAvailed}</td>
                        <td>${dueDate}</td>
                        <td>${createdAt}</td>
                        <td>${createdAtTime}</td>
                    </tr>
                `;
                })
                .join('');

            tableBody.html(rows);
        } else {
            tableBody.html(
                '<tr><td colspan="5" class="text-center">No services found.</td></tr>'
            );
        }
    }

    $('#historyBeneficiaryModal').on('hidden.bs.modal', function () {
        $(this).find('input, select').val('');
    });
    // ------------------------------------------------------------------------------------------------------------- //

    $('#searchBeneficiaryInput').on('keyup', function () {
        let searchQuery = $(this).val();

        $.ajax({
            url: '/Page/Beneficiary',
            type: 'GET',
            data: { search: searchQuery },
            success: function (response) {
                $('#beneficiaryTableContainer').html(response.table);

                if (response.hidePagination) {
                    $('.pagination').hide();
                } else {
                    $('.pagination').show();
                }

                bindActionButtons();
            },
        });
    });

    function bindActionButtons() {
        // Open Profile Modal
        $('.profile-button').on('click', function () {
            let beneficiaryId = $(this).data('id');

            $('#profileBeneficiaryForm')[0].reset();

            $.ajax({
                url: `/Beneficiaries/${beneficiaryId}`,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        const data = response.data;
                        $('#profileBeneficiaryId').val(data.id || '');
                        $('#profileFirstname').val(data.firstname || '');
                        $('#profileMiddlename').val(data.middlename || '');
                        $('#profileLastname').val(data.lastname || '');
                        $('#profileSuffix').val(data.suffix || '');
                        $('#profileSex').val(data.sex || '');

                        if (data.birthdate) {
                            const dateObj = new Date(data.birthdate);
                            const formattedDate = dateObj.toLocaleDateString(
                                'en-US',
                                {
                                    year: 'numeric',
                                    month: 'long',
                                    day: '2-digit',
                                }
                            );
                            $('#profileBirthdate').val(formattedDate);
                        } else {
                            $('#profileBirthdate').val('');
                        }

                        $('#profileStatus').val(data.status || '');
                        $('#profileCategory').val(data.category || '');
                        $('#profileRemarks').val(data.remarks || '');

                        if (data.address) {
                            $('#profileStreetname').val(
                                data.address.streetname || ''
                            );
                            $('#profileBarangay').val(
                                data.address.barangay || ''
                            );
                            $('#profileMunicipality').val(
                                data.address.municipality || ''
                            );
                            $('#profileProvince').val(
                                data.address.province || ''
                            );
                        }

                        if (data.services && data.services.length > 0) {
                            const filteredService = data.services.find(
                                (service) =>
                                    service.service_name === 'CAR' ||
                                    service.service_name === 'CICL'
                            );
                            if (filteredService) {
                                if (
                                    filteredService.service_name === 'CAR' ||
                                    filteredService.service_name === 'CICL'
                                ) {
                                    $('#profileChildCaseContainer').removeClass(
                                        'd-none'
                                    );
                                }
                            } else {
                                $('#profileChildCaseContainer').addClass(
                                    'd-none'
                                );
                            }
                        } else {
                            $('#profileChildCaseContainer').addClass('d-none');
                        }

                        // Show the modal
                        $('#profileBeneficiaryModal').modal('show');
                    } else {
                        alert(
                            'Failed to fetch beneficiary details. Please try again.'
                        );
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching beneficiary data:', {
                        status: xhr.status,
                        statusText: xhr.statusText,
                        responseText: xhr.responseText,
                        error: error,
                    });
                },
            });
        });

        // Open Service Modal
        $('.service-button').on('click', function () {
            let beneficiaryId = $(this).data('id');

            $.ajax({
                url: `/Beneficiaries/${beneficiaryId}`,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        const data = response.data;
                        $('#serviceBeneficiaryId').val(data.id || '');
                        $('#serviceBeneficiaryModal').modal('show');
                    } else {
                        alert(
                            'Failed to fetch beneficiary details. Please try again.'
                        );
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching beneficiary data:', {
                        status: xhr.status,
                        statusText: xhr.statusText,
                        responseText: xhr.responseText,
                        error: error,
                    });
                },
            });
        });

        // Open History Modal
        $('.history-button').on('click', function () {
            const beneficiaryId = $(this).data('id');
            $('#historyBeneficiaryId').val(beneficiaryId);
            $('#historyBeneficiaryModal').modal('show');

            const tableBody = $('#historyBeneficiaryTable');
            tableBody.html(
                '<tr><td colspan="5" class="text-center">Loading...</td></tr>'
            );

            $.ajax({
                url: `/Beneficiaries/${beneficiaryId}`,
                type: 'GET',
                success: function (response) {
                    if (response.success) {
                        populateTable(response.data.services);
                    } else {
                        tableBody.html(
                            '<tr><td colspan="5" class="text-danger text-center">Failed to load services.</td></tr>'
                        );
                    }
                },
                error: function () {
                    tableBody.html(
                        '<tr><td colspan="5" class="text-danger text-center">An error occurred.</td></tr>'
                    );
                },
            });
        });
    }
    bindActionButtons();
});
