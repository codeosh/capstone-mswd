// resources\js\app.js
import './bootstrap';
import 'bootstrap';

$(document).ready(function () {
    // ---------------------------------------------------------------------- //

    // Focus on the search input when dropdown is shown
    $('#barangayDropdown').on('click', function () {
        $('#barangaySearch').val('');
        $('#barangayList li').show();
    });

    $('#barangaySearch').on('keyup', function () {
        const searchValue = $(this).val().toLowerCase().trim();
        $('#barangayList li').filter(function () {
            const text = $(this).text().toLowerCase().trim();

            const normalizedText = text
                .replace(/[^\w\s]/gi, '')
                .replace(/\s+/g, ' ');
            const normalizedSearch = searchValue
                .replace(/[^\w\s]/gi, '')
                .replace(/\s+/g, ' ');

            $(this).toggle(normalizedText.indexOf(normalizedSearch) > -1);
        });
    });

    $('#barangayList').on('click', 'a', function (e) {
        e.preventDefault();
        const selectedValue = $(this).data('value');
        $('#barangayDropdown').text(selectedValue);
        $('#selectedBarangay').val(selectedValue);
    });

    $(document).on('click', function (e) {
        if (!$(e.target).closest('.dropdown').length) {
            $('#barangayDropdown').dropdown('hide');
        }
    });

    // ---------------------------------------------------------------------- //

    // Add Beneficiary Form Validation
    const addBeneficiaryForm = document.getElementById('addBeneficiaryForm');
    if (addBeneficiaryForm) {
        addBeneficiaryForm.addEventListener('reset', function () {
            this.classList.remove('was-validated');
        });

        addBeneficiaryForm.addEventListener('submit', function (event) {
            if (!this.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            this.classList.add('was-validated');
        });
    }

    const addBeneficiaryModal = document.getElementById('addBeneficiaryModal');
    if (addBeneficiaryModal) {
        addBeneficiaryModal.addEventListener('hidden.bs.modal', () => {
            if (addBeneficiaryForm) {
                addBeneficiaryForm.reset();
                addBeneficiaryForm.classList.remove('was-validated');
            }
            const serviceType = $('#serviceTypeSelect').val();
            const status = $('#status').val();
            if (
                (serviceType === 'CAR' || serviceType === 'CICL') &&
                status === 'Child or Youth'
            ) {
                $('.child-cases-section').removeClass('d-none');
            } else {
                $('.child-cases-section').addClass('d-none');
            }
        });
    }
    // ---------------------------------------------------------------------- //
});
