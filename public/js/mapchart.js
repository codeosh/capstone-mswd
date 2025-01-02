document.addEventListener('DOMContentLoaded', function () {
    // Initialize the map
    var map = L.map('map').setView([10.384461, 124.980933], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
    }).addTo(map);

    // Example Marker
    var marker = L.marker([10.384461, 124.980933]).addTo(map);
    marker
        .bindPopup('<b>MSWDO Office</b><br>Sogod, Southern Leyte')
        .openPopup();

    // Add event listener for the filter dropdown
    var filterServiceMap = document.getElementById('filterServiceMap');
    if (filterServiceMap) {
        filterServiceMap.addEventListener('change', function () {
            var selectedFilter = this.value;
            console.log('Selected Filter:', selectedFilter);
            // Add your filtering logic here
        });
    }

    // Initialize ApexChart
    var options = {
        chart: {
            type: 'bar',
            height: 250,
        },
        series: [
            {
                name: 'Example Data',
                data: [10, 15, 8, 12, 20],
            },
        ],
        xaxis: {
            categories: ['AICS', 'VAW', 'VAC', 'CAR', 'CICL'],
        },
    };

    var chart = new ApexCharts(document.querySelector('#chart'), options);
    chart.render();

    // Initialize Line Chart
    var lineOptions = {
        chart: {
            type: 'line',
            height: 250,
        },
        series: [
            {
                name: 'Trend Data',
                data: [5, 10, 15, 10, 5],
            },
        ],
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
        },
    };

    var lineChart = new ApexCharts(
        document.querySelector('#lineChart'),
        lineOptions
    );
    lineChart.render();
});
