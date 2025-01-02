// public\js\printreport.js
$(document).ready(function () {
    const mswdIconUrl = 'http://127.0.0.1:8000/images/logo/mswd-icon.png';
    const sogodLogoUrl = 'http://127.0.0.1:8000/images/logo/sogodlogo.png';

    // Functions for Print button
    $('#printButtonReport').on('click', function () {
        const visibleHeaders = $('table thead th:not(.d-none)');
        const visibleContent = $('.reportTableContainer tr')
            .map(function () {
                return (
                    '<tr>' +
                    $(this)
                        .children('td:not(.d-none)')
                        .get()
                        .map(function (cell) {
                            return '<td>' + $(cell).html() + '</td>';
                        })
                        .join('') +
                    '</tr>'
                );
            })
            .get()
            .join('');

        const reportTitle = $('#reportTitle').val() || 'Generated Report';
        const officeEmail = $('#officeEmail').val() || 'mswdlgusogod@gmail.com';
        const officeCell = $('#officeCell').val() || '09090172012';

        const iframe = document.createElement('iframe');
        iframe.style.display = 'none';
        document.body.appendChild(iframe);

        const images = [new Image(), new Image()];

        images[0].src = mswdIconUrl;
        images[1].src = sogodLogoUrl;

        Promise.all(
            images.map(
                (img) =>
                    new Promise((resolve) => {
                        img.onload = resolve;
                        img.onerror = resolve;
                    })
            )
        ).then(() => {
            const htmlContent = `
                <html>
                <head>
                    <style>
                        body { font-family: Arial, sans-serif; text-align: center; }
                        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
                        th { background-color: #f2f2f2; }
                        .header-container { display: flex; justify-content: center; align-items: center; gap: 10px; margin-bottom: 20px; }
                        .header-container img { width: 100px; height: auto; }
                        .header-container p { font-size: 16px; margin: 0; }
                        .contact-info { font-size: 14px; margin-top: 10px; font-weight: normal; }
                        @media print { @page { margin: 20px; } }
                    </style>
                </head>
                <body>
                    <div class="header-container">
                        <img src="${mswdIconUrl}" alt="MSWD Icon"">
                        <p>Republic of the Philippines<br>Province of Southern Leyte<br>Municipality of Sogod</p>
                        <img src="${sogodLogoUrl}" alt="Sogod Logo">
                    </div>
                    <div class="contact-info">
                        Municipal Social Welfare and Development Office<br>
                        Email Address:${officeEmail}<br>
                        Office Cell Number: ${officeCell}
                    </div>
                    <h3>${reportTitle}</h3>
                    <table><thead>
                        ${visibleHeaders
                            .get()
                            .map(function (header) {
                                return '<th>' + $(header).html() + '</th>';
                            })
                            .join('')}
                    </thead><tbody>
                        ${visibleContent}
                    </tbody></table>
                </body>
                </html>`;

            iframe.srcdoc = htmlContent;

            iframe.onload = function () {
                iframe.contentWindow.focus();
                iframe.contentWindow.print();

                setTimeout(() => {
                    document.body.removeChild(iframe);
                }, 1000);
            };
        });
    });
    // End of Print function button

    // Generate Report Functionalities
    $('#filterButtonReport').on('click', function () {
        const serviceType = $('#selectReportFilterType').val();
        const startDate = $('#filterReportStartDate').val();
        const endDate = $('#filterReportEndDate').val();
        $('#rowsPerPage').val(10);

        if (!serviceType) {
            showToast('Please select a Filter Type', 'danger');
            return;
        }

        filterBeneficiaries(serviceType, startDate, endDate);
    });
    $('#clearButtonReport').on('click', function () {
        $('#selectReportFilterType').val('');
        $('#filterReportStartDate').val('');
        $('#filterReportEndDate').val('');
        $('#rowsPerPage').val(10);

        filterBeneficiaries();
    });

    $('#rowsPerPage').change(function () {
        const perPage = $(this).val();
        const serviceType = $('#selectReportFilterType').val();
        const startDate = $('#filterReportStartDate').val();
        const endDate = $('#filterReportEndDate').val();

        filterBeneficiaries(serviceType, startDate, endDate, perPage);
    });

    function filterBeneficiaries(
        serviceType = '',
        startDate = '',
        endDate = '',
        perPage = 10
    ) {
        const tableBody = $('.reportTableContainer');
        tableBody.html(
            '<tr><td colspan="8" class="text-center">Loading...</td></tr>'
        );

        $.ajax({
            url: '/generate-report/filter',
            type: 'GET',
            data: {
                reportFilterType: serviceType,
                startDate,
                endDate,
                perPage,
            },
            success: function (response) {
                if (response.success && response.data.length > 0) {
                    populateBeneficiaryTable(response.data, serviceType);
                } else {
                    tableBody.html(
                        '<tr><td colspan="8" class="text-center">No beneficiaries found.</td></tr>'
                    );
                }
            },
            error: function () {
                tableBody.html(
                    '<tr><td colspan="8" class="text-center text-danger">An error occurred while fetching data.</td></tr>'
                );
            },
        });
    }

    function populateBeneficiaryTable(beneficiaries, serviceType = '') {
        const tableBody = $('.reportTableContainer');

        if (serviceType === 'Solo Parent') {
            $('#categoryHeader').removeClass('d-none');
            $('#remarksHeader').removeClass('d-none');
            $('#sexHeader').addClass('d-none');
            $('#birthdateHeader').addClass('d-none');
            $('#statusHeader').addClass('d-none');
        } else {
            $('#categoryHeader').addClass('d-none');
            $('#remarksHeader').addClass('d-none');
            $('#sexHeader').removeClass('d-none');
            $('#birthdateHeader').removeClass('d-none');
            $('#statusHeader').removeClass('d-none');
        }

        // Generate table rows
        const rows = beneficiaries
            .map((beneficiary, index) => {
                const birthDate = new Date(beneficiary.birthdate);
                const age = new Date().getFullYear() - birthDate.getFullYear();
                const barangay = beneficiary.address
                    ? beneficiary.address.barangay
                    : 'N/A';

                const category =
                    beneficiary.category && beneficiary.category.trim() !== ''
                        ? beneficiary.category
                        : 'N/A';
                const remarks =
                    beneficiary.remarks && beneficiary.remarks.trim() !== ''
                        ? beneficiary.remarks
                        : 'N/A';

                if (serviceType === 'Solo Parent') {
                    return `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${beneficiary.id_num}</td>
                        <td>${beneficiary.firstname} ${
                        beneficiary.middlename || ''
                    } ${beneficiary.lastname} ${beneficiary.suffix || ''}</td>
                        <td>${barangay}</td>
                        <td>${age}</td>
                        <td>${category}</td>
                        <td>${remarks}</td>
                    </tr>
                `;
                } else {
                    return `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${beneficiary.id_num}</td>
                        <td>${beneficiary.firstname} ${
                        beneficiary.middlename || ''
                    } ${beneficiary.lastname} ${beneficiary.suffix || ''}</td>
                        <td>${barangay}</td>
                        <td>${beneficiary.sex}</td>
                        <td>${birthDate.toLocaleDateString('en-US', {
                            month: 'long',
                            day: '2-digit',
                            year: 'numeric',
                        })}</td>
                        <td>${age}</td>
                        <td>${beneficiary.status}</td>
                    </tr>
                `;
                }
            })
            .join('');

        console.log('Generated rows:', rows);

        tableBody.html(rows);
    }
    // End of Generate Report Functionalities
});
