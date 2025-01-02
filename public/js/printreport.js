// public\js\printreport.js
$(document).ready(function () {
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

        // Open a new print window
        const printWindow = window.open('', '', 'height=600,width=1000');

        printWindow.document.write('<html><head>');
        printWindow.document.write(
            '<style>' +
                'body { font-family: Arial, sans-serif; text-align: center; }' +
                'table { width: 100%; border-collapse: collapse; margin-top: 20px; }' +
                'th, td { border: 1px solid #000; padding: 8px; text-align: center; }' +
                'th { background-color: #f2f2f2; }' +
                '@media print { ' +
                '  body { margin: 0; padding: 0; }' +
                '  .no-print { display: none; }' +
                '  @page { margin: 20px; size: auto; }' +
                '}' +
                '.header-container { display: flex; justify-content: center; align-items: center; gap: 10px; margin-bottom: 20px; }' +
                '.header-container img { width: 100px; height: auto; }' +
                '.header-container p { font-size: 16px; margin: 0; }' +
                '.contact-info { font-size: 14px; margin-top: 10px; font-weight: normal; }' +
                '</style>'
        );
        printWindow.document.write('</head><body>');

        printWindow.document.write('<div class="header-container">');
        printWindow.document.write(
            '<img src="/images/logo/mswd-icon.png" alt="MSWD Icon">'
        );
        printWindow.document.write(
            '<p>Republic of the Philippines<br>Province of Southern Leyte<br>Municipality of Sogod</p>'
        );
        printWindow.document.write(
            '<img src="/images/logo/sogodlogo.png" alt="Sogod Logo">'
        );
        printWindow.document.write('</div>');

        printWindow.document.write('<div class="contact-info">');
        printWindow.document.write(
            'Municipal Social Welfare and Development Office<br>' +
                'Email Address: mswdlgusogod@gmail.com<br>' +
                'Office Cell Number: 09090172012'
        );
        printWindow.document.write('</div>');

        printWindow.document.write('<h3>Generated Report</h3>');
        printWindow.document.write(
            '<table><thead>' +
                visibleHeaders
                    .get()
                    .map(function (header) {
                        return '<th>' + $(header).html() + '</th>';
                    })
                    .join('') +
                '</thead><tbody>' +
                visibleContent +
                '</tbody></table>'
        );
        printWindow.document.write('</body></html>');

        printWindow.document.close();

        printWindow.onload = function () {
            printWindow.print();
            printWindow.close();
        };
    });
});
