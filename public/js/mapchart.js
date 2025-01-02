// public\js\mapchart.js
import ApexCharts from 'apexcharts';

// Initialize the map
var map = L.map('map').setView([14.5995, 120.9842], 13); // Default coordinates (Manila, Philippines)

// Add OpenStreetMap tile layer
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors',
}).addTo(map);

// Example Marker
var marker = L.marker([14.5995, 120.9842]).addTo(map);
marker.bindPopup('<b>MSWDO Office</b><br>Manila, Philippines').openPopup();

// Add event listener for the filter dropdown (if needed for filtering markers)
document
    .getElementById('filterServiceMap')
    .addEventListener('change', function () {
        var selectedFilter = this.value;
        console.log('Selected Filter:', selectedFilter);
        // Add your filtering logic here
    });

// Initialize ApexChart
var options = {
    chart: {
        type: 'bar',
        height: 500,
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
