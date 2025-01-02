// public\js\beneficiarylogs.js
fetch('/getBeneficiaryTableData')
    .then((response) => response.json())
    .then((data) => {
        const beneficiaries = data.beneficiaries;
        const tableBody = document.getElementById('beneficiaryLogsTable');

        beneficiaries.forEach((beneficiary) => {
            // Format the dates to "January 01, 2024, 12:00 AM"
            const dateAdded = new Date(beneficiary.date_added).toLocaleString(
                'en-US',
                {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true,
                }
            );

            const dateUpdated = new Date(
                beneficiary.date_updated
            ).toLocaleString('en-US', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                hour12: true,
            });

            const row = document.createElement('tr');
            row.innerHTML = `
                    <td>${beneficiary.account_name}</td>
                    <td>${beneficiary.beneficiary_name}</td>
                    <td>${dateAdded}</td>
                    <td>${dateUpdated}</td>
                `;
            tableBody.appendChild(row);
        });
    })
    .catch((error) => {
        console.error('Error fetching beneficiary data:', error);
    });
