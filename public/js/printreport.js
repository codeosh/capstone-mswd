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

        // Create a hidden iframe for printing
        const iframe = document.createElement('iframe');
        iframe.style.display = 'none';
        document.body.appendChild(iframe);

        const images = [new Image(), new Image()];

        // Set image sources
        images[0].src = mswdIconUrl;
        images[1].src = sogodLogoUrl;

        // Wait for both images to load
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
                        Email Address: mswdlgusogod@gmail.com<br>
                        Office Cell Number: 09090172012
                    </div>
                    <h3>Generated Report</h3>
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
});
