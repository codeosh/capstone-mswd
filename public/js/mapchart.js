document.addEventListener('DOMContentLoaded', function () {
    // Initialize the map
    var map = L.map('map').setView([10.442064, 124.988804], 12);

    var solidColorLayer = L.tileLayer('', {
        attribution: 'Custom Solid Color Background',
    });

    solidColorLayer.on('tileloadstart', function (event) {
        var canvas = document.createElement('canvas');
        canvas.width = 256;
        canvas.height = 256;
        var ctx = canvas.getContext('2d');
        ctx.fillStyle = '#f5f5f5';
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        event.tile.src = canvas.toDataURL();
    });
    solidColorLayer.addTo(map);

    // Load GeoJSON data
    fetch('/mapping/Sogod_Brgys.geojson')
        .then((response) => response.json())
        .then((data) => {
            L.geoJson(data, {
                style: function (feature) {
                    return {
                        fillColor: getColor(feature.properties.AREA_SQKM),
                        weight: 2,
                        opacity: 1,
                        color: 'white',
                        fillOpacity: 1,
                        className: 'mapEffects',
                    };
                },
                onEachFeature: function (feature, layer) {
                    layer.bindPopup(
                        `<b>Barangay:</b> ${feature.properties.ADM4_EN}<br>` +
                            `<b>Area (sq km):</b> ${feature.properties.AREA_SQKM}`
                    );
                },
            }).addTo(map);
        })
        .catch((error) => console.error('Error loading GeoJSON:', error));

    function getColor(value) {
        return value > 100
            ? '#800026'
            : value > 50
            ? '#BD0026'
            : value > 20
            ? '#E31A1C'
            : value > 10
            ? '#FC4E2A'
            : value > 5
            ? '#FD8D3C'
            : value > 0
            ? '#FEB24C'
            : '#FFEDA0';
    }

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
