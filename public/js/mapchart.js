document.addEventListener('DOMContentLoaded', function () {
    // Initialize the map
    var map = L.map('map').setView([10.442064, 124.988804], 12);

    var solidColorLayer = L.tileLayer('', {
        attribution:
            '<img src="https://upload.wikimedia.org/wikipedia/commons/9/99/Flag_of_the_Philippines.svg" ' +
            'style="width: 20px; vertical-align: middle;" alt="Philippines Flag"> Sogod, Southern Leyte',
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

    fetch('/getBarangayData')
        .then((response) => {
            if (!response.ok) {
                throw new Error('Failed to fetch barangay data');
            }
            return response.json();
        })
        .then((data) => {
            const barangayData = data.barangayData;
            if (!Array.isArray(barangayData)) {
                console.error(
                    'Expected barangayData to be an array, but got:',
                    barangayData
                );
                return;
            }
            fetch('/mapping/Sogod_Brgys.geojson')
                .then((response) => response.json())
                .then((geoJsonData) => {
                    L.geoJson(geoJsonData, {
                        style: function (feature) {
                            const barangayInfo = barangayData.find(
                                (barangay) =>
                                    barangay.barangay ===
                                    feature.properties.ADM4_EN
                            );
                            const serviceCount = barangayInfo
                                ? barangayInfo.total_beneficiaries
                                : 0;
                            return {
                                fillColor: getColor(serviceCount),
                                weight: 2,
                                opacity: 1,
                                color: 'white',
                                fillOpacity: 1,
                                className: 'mapEffects',
                            };
                        },
                        onEachFeature: function (feature, layer) {
                            const barangayInfo = barangayData.find(
                                (barangay) =>
                                    barangay.barangay ===
                                    feature.properties.ADM4_EN
                            );

                            if (barangayInfo) {
                                layer.bindPopup(
                                    `<b>Barangay:</b> ${feature.properties.ADM4_EN}<br>` +
                                        `<b>Total Beneficiaries:</b> ${barangayInfo.total_beneficiaries}<br>` +
                                        `<b>Solo Parent Count:</b> ${barangayInfo.solo_parent_count}<br>` +
                                        `<b>AICS Services:</b> ${barangayInfo.aics_count}<br>` +
                                        `<b>VAW Services:</b> ${barangayInfo.vaw_count}<br>` +
                                        `<b>VAC Services:</b> ${barangayInfo.vac_count}<br>` +
                                        `<b>CAR Services:</b> ${barangayInfo.car_count}<br>` +
                                        `<b>CICL Services:</b> ${barangayInfo.cicl_count}`
                                );
                            }
                        },
                    }).addTo(map);

                    // Add the legend to the map
                    var legend = L.control({ position: 'bottomright' });

                    legend.onAdd = function () {
                        var div = L.DomUtil.create('div', 'info legend');
                        div.style.backgroundColor = 'white';
                        div.style.padding = '10px';
                        div.style.borderRadius = '5px';
                        div.style.boxShadow = '0 0 5px rgba(0, 0, 0, 0.5)';
                        div.style.fontSize = '12px';

                        var grades = [0, 5, 10, 20, 50, 100];

                        for (var i = 0; i < grades.length; i++) {
                            div.innerHTML +=
                                '<div style="display: flex; align-items: center; margin-bottom: 5px;">' +
                                '<i style="background:' +
                                getColor(grades[i]) +
                                '; width: 20px; height: 20px; margin-right: 5px;"></i>' +
                                '<span>' +
                                grades[i] +
                                (grades[i + 1]
                                    ? '&ndash;' + grades[i + 1] + ''
                                    : '+') +
                                '</span>' +
                                '</div>';
                        }
                        return div;
                    };

                    legend.addTo(map);
                })
                .catch((error) =>
                    console.error('Error loading GeoJSON:', error)
                );
        })
        .catch((error) => {
            console.error('Error fetching barangay data:', error);
            alert('Failed to load barangay data.');
        });

    // Function to get color based on service count
    function getColor(value) {
        if (value === 0) return '#FFEDA0';
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
            : '#FEB24C';
    }

    // Function to filter map data based on selected filters
    function filterMapData() {
        const filterType = document.getElementById('selectMapFilterType').value;
        const monthFilter = document.getElementById('selectMonthFilter').value;
        const yearFilter = document.getElementById('selectYearFilter').value;

        fetch(
            `/getBarangayData?mapFilterType=${filterType}&selectMonthFilter=${monthFilter}&selectYearFilter=${yearFilter}`
        )
            .then((response) => {
                if (!response.ok) {
                    throw new Error('Failed to fetch filtered barangay data');
                }
                return response.json();
            })
            .then((data) => {
                const barangayData = data.barangayData;

                // Clear existing map layers
                map.eachLayer((layer) => {
                    if (layer !== solidColorLayer) {
                        map.removeLayer(layer);
                    }
                });

                // Reload GeoJSON with filtered data
                fetch('/mapping/Sogod_Brgys.geojson')
                    .then((response) => response.json())
                    .then((geoJsonData) => {
                        L.geoJson(geoJsonData, {
                            style: function (feature) {
                                const barangayInfo = barangayData.find(
                                    (barangay) =>
                                        barangay.barangay ===
                                        feature.properties.ADM4_EN
                                );
                                const serviceCount = barangayInfo
                                    ? barangayInfo.total_beneficiaries
                                    : 0;
                                return {
                                    fillColor: getColor(serviceCount),
                                    weight: 2,
                                    opacity: 1,
                                    color: 'white',
                                    fillOpacity: 1,
                                    className: 'mapEffects',
                                };
                            },
                            onEachFeature: function (feature, layer) {
                                const barangayInfo = barangayData.find(
                                    (barangay) =>
                                        barangay.barangay ===
                                        feature.properties.ADM4_EN
                                );

                                if (barangayInfo) {
                                    layer.bindPopup(
                                        `<b>Barangay:</b> ${feature.properties.ADM4_EN}<br>` +
                                            `<b>Total Beneficiaries:</b> ${barangayInfo.total_beneficiaries}<br>` +
                                            `<b>${filterType} Count:</b> ${
                                                barangayInfo[
                                                    `${filterType.toLowerCase()}_count`
                                                ]
                                            }`
                                    );
                                }
                            },
                        }).addTo(map);
                    })
                    .catch((error) =>
                        console.error('Error loading GeoJSON:', error)
                    );
            })
            .catch((error) => {
                console.error('Error fetching filtered barangay data:', error);
                alert('Failed to load filtered barangay data.');
            });
    }

    // Functions for Charts
    fetch('/getBarangayData')
        .then((response) => response.json())
        .then((data) => {
            const barangayData = data.barangayData;
            const yearlyTrendData = data.yearlyTrendData;

            const lineChartData = [
                { name: 'Solo Parent', data: [] },
                { name: 'AICS', data: [] },
                { name: 'VAW', data: [] },
                { name: 'VAC', data: [] },
                { name: 'CAR', data: [] },
                { name: 'CICL', data: [] },
            ];

            barangayData.forEach((barangay) => {
                lineChartData[0].data.push(barangay.solo_parent_count);
                lineChartData[1].data.push(barangay.aics_count);
                lineChartData[2].data.push(barangay.vaw_count);
                lineChartData[3].data.push(barangay.vac_count);
                lineChartData[4].data.push(barangay.car_count);
                lineChartData[5].data.push(barangay.cicl_count);
            });

            // Initialize Line Chart
            var lineOptions = {
                chart: {
                    type: 'line',
                    height: 250,
                },
                series: lineChartData,
                xaxis: {
                    categories: barangayData.map(
                        (barangay) => barangay.barangay
                    ),
                },
            };

            var lineChart = new ApexCharts(
                document.querySelector('#lineChart'),
                lineOptions
            );
            lineChart.render();

            const barChartData = [
                { name: 'Solo Parent', data: [] },
                { name: 'AICS', data: [] },
                { name: 'VAW', data: [] },
                { name: 'VAC', data: [] },
                { name: 'CAR', data: [] },
                { name: 'CICL', data: [] },
            ];

            yearlyTrendData.forEach((trend) => {
                barChartData[0].data.push(trend.solo_parent_count);
                barChartData[1].data.push(trend.aics_count);
                barChartData[2].data.push(trend.vaw_count);
                barChartData[3].data.push(trend.vac_count);
                barChartData[4].data.push(trend.car_count);
                barChartData[5].data.push(trend.cicl_count);
            });

            // Initialize Bar Chart
            var barOptions = {
                chart: {
                    type: 'bar',
                    height: 250,
                },
                series: barChartData,
                xaxis: {
                    categories: yearlyTrendData.map((trend) => trend.year),
                },
            };

            var barChart = new ApexCharts(
                document.querySelector('#barChart'),
                barOptions
            );
            barChart.render();

            function fetchFilteredLineChartData(filterType, month, year) {
                // Construct the query parameters
                const queryParams = new URLSearchParams();
                if (filterType) queryParams.append('mapFilterType', filterType);
                if (month) queryParams.append('selectMonthFilter', month);
                if (year) queryParams.append('selectYearFilter', year);

                // Fetch the filtered data
                return fetch(`/getBarangayData?${queryParams.toString()}`)
                    .then((response) => response.json())
                    .then((data) => data.barangayData) // Return only barangayData for the line chart
                    .catch((error) => {
                        console.error(
                            'Error fetching filtered line chart data:',
                            error
                        );
                        return [];
                    });
            }

            function updateLineChart(filterType, month, year) {
                fetchFilteredLineChartData(filterType, month, year).then(
                    (barangayData) => {
                        const lineChartData = [
                            { name: 'Solo Parent', data: [] },
                            { name: 'AICS', data: [] },
                            { name: 'VAW', data: [] },
                            { name: 'VAC', data: [] },
                            { name: 'CAR', data: [] },
                            { name: 'CICL', data: [] },
                        ];

                        barangayData.forEach((barangay) => {
                            lineChartData[0].data.push(
                                barangay.solo_parent_count
                            );
                            lineChartData[1].data.push(barangay.aics_count);
                            lineChartData[2].data.push(barangay.vaw_count);
                            lineChartData[3].data.push(barangay.vac_count);
                            lineChartData[4].data.push(barangay.car_count);
                            lineChartData[5].data.push(barangay.cicl_count);
                        });

                        const lineOptions = {
                            chart: {
                                type: 'line',
                                height: 250,
                            },
                            series: lineChartData,
                            xaxis: {
                                categories: barangayData.map(
                                    (barangay) => barangay.barangay
                                ),
                            },
                        };

                        // Destroy and recreate the chart
                        if (lineChart) {
                            lineChart.destroy();
                        }

                        lineChart = new ApexCharts(
                            document.querySelector('#lineChart'),
                            lineOptions
                        );
                        lineChart.render();
                    }
                );
            }

            function applyLineChartFilter() {
                const filterType = document.getElementById(
                    'selectMapFilterType'
                ).value;
                const month =
                    document.getElementById('selectMonthFilter').value;
                const year = document.getElementById('selectYearFilter').value;

                // Update the line chart with the selected filters
                updateLineChart(filterType, month, year);
            }

            function applyYearFilter(year) {
                // Fetch the filtered data from the backend
                fetch(`/getBarangayData?selectYearFilter=${year}`)
                    .then((response) => response.json())
                    .then((data) => {
                        let yearlyTrendData = data.yearlyTrendData;

                        if (year) {
                            yearlyTrendData = yearlyTrendData.filter(
                                (trend) => trend.year == year
                            );
                        }
                        const barChartData = [
                            { name: 'Solo Parent', data: [] },
                            { name: 'AICS', data: [] },
                            { name: 'VAW', data: [] },
                            { name: 'VAC', data: [] },
                            { name: 'CAR', data: [] },
                            { name: 'CICL', data: [] },
                        ];

                        yearlyTrendData.forEach((trend) => {
                            barChartData[0].data.push(trend.solo_parent_count);
                            barChartData[1].data.push(trend.aics_count);
                            barChartData[2].data.push(trend.vaw_count);
                            barChartData[3].data.push(trend.vac_count);
                            barChartData[4].data.push(trend.car_count);
                            barChartData[5].data.push(trend.cicl_count);
                        });

                        var barOptions = {
                            chart: {
                                type: 'bar',
                                height: 250,
                            },
                            series: barChartData,
                            xaxis: {
                                categories: yearlyTrendData.map(
                                    (trend) => trend.year
                                ),
                            },
                        };

                        if (barChart) {
                            barChart.destroy();
                        }

                        barChart = new ApexCharts(
                            document.querySelector('#barChart'),
                            barOptions
                        );
                        barChart.render();
                    })
                    .catch((error) => {
                        console.error('Error fetching filtered data:', error);
                    });
            }

            function resetLineChart(barangayData) {
                // Validate barangayData
                if (!Array.isArray(barangayData)) {
                    console.error('Invalid barangayData:', barangayData);
                    return;
                }

                const lineChartData = [
                    { name: 'Solo Parent', data: [] },
                    { name: 'AICS', data: [] },
                    { name: 'VAW', data: [] },
                    { name: 'VAC', data: [] },
                    { name: 'CAR', data: [] },
                    { name: 'CICL', data: [] },
                ];

                barangayData.forEach((barangay) => {
                    lineChartData[0].data.push(barangay.solo_parent_count || 0);
                    lineChartData[1].data.push(barangay.aics_count || 0);
                    lineChartData[2].data.push(barangay.vaw_count || 0);
                    lineChartData[3].data.push(barangay.vac_count || 0);
                    lineChartData[4].data.push(barangay.car_count || 0);
                    lineChartData[5].data.push(barangay.cicl_count || 0);
                });

                const lineOptions = {
                    chart: {
                        type: 'line',
                        height: 250,
                    },
                    series: lineChartData,
                    xaxis: {
                        categories: barangayData.map(
                            (barangay) => barangay.barangay || 'Unknown'
                        ),
                    },
                };

                // Destroy and recreate the line chart
                if (typeof lineChart !== 'undefined') {
                    lineChart.destroy();
                }

                lineChart = new ApexCharts(
                    document.querySelector('#lineChart'),
                    lineOptions
                );
                lineChart.render();
            }

            // Attach the filter function to the filter button
            document
                .getElementById('applyFilterButton')
                .addEventListener('click', function () {
                    const selectedYear =
                        document.getElementById('selectYearFilter').value;
                    filterMapData();
                    applyLineChartFilter();
                    applyYearFilter(selectedYear);
                });

            document
                .getElementById('clearFilterMapButton')
                .addEventListener('click', () => {
                    // Reset filter inputs
                    document.getElementById('selectMapFilterType').value = '';
                    document.getElementById('selectMonthFilter').value = '';
                    document.getElementById('selectYearFilter').value = '';

                    // Clear existing map layers
                    map.eachLayer((layer) => {
                        if (layer !== solidColorLayer) {
                            map.removeLayer(layer);
                        }
                    });

                    // Reinitialize the default map view
                    fetch('/getBarangayData')
                        .then((response) => {
                            if (!response.ok) {
                                throw new Error(
                                    'Failed to fetch barangay data'
                                );
                            }
                            return response.json();
                        })
                        .then((data) => {
                            const barangayData = data.barangayData;
                            if (!Array.isArray(barangayData)) {
                                console.error(
                                    'Expected barangayData to be an array, but got:',
                                    barangayData
                                );
                                return;
                            }

                            resetLineChart(barangayData);
                            fetch('/mapping/Sogod_Brgys.geojson')
                                .then((response) => response.json())
                                .then((geoJsonData) => {
                                    L.geoJson(geoJsonData, {
                                        style: function (feature) {
                                            const barangayInfo =
                                                barangayData.find(
                                                    (barangay) =>
                                                        barangay.barangay ===
                                                        feature.properties
                                                            .ADM4_EN
                                                );
                                            const serviceCount = barangayInfo
                                                ? barangayInfo.total_beneficiaries
                                                : 0;
                                            return {
                                                fillColor:
                                                    getColor(serviceCount),
                                                weight: 2,
                                                opacity: 1,
                                                color: 'white',
                                                fillOpacity: 1,
                                                className: 'mapEffects',
                                            };
                                        },
                                        onEachFeature: function (
                                            feature,
                                            layer
                                        ) {
                                            const barangayInfo =
                                                barangayData.find(
                                                    (barangay) =>
                                                        barangay.barangay ===
                                                        feature.properties
                                                            .ADM4_EN
                                                );

                                            if (barangayInfo) {
                                                layer.bindPopup(
                                                    `<b>Barangay:</b> ${feature.properties.ADM4_EN}<br>` +
                                                        `<b>Total Beneficiaries:</b> ${barangayInfo.total_beneficiaries}<br>` +
                                                        `<b>Solo Parent Count:</b> ${barangayInfo.solo_parent_count}<br>` +
                                                        `<b>AICS Services:</b> ${barangayInfo.aics_count}<br>` +
                                                        `<b>VAW Services:</b> ${barangayInfo.vaw_count}<br>` +
                                                        `<b>VAC Services:</b> ${barangayInfo.vac_count}<br>` +
                                                        `<b>CAR Services:</b> ${barangayInfo.car_count}<br>` +
                                                        `<b>CICL Services:</b> ${barangayInfo.cicl_count}`
                                                );
                                            }
                                        },
                                    }).addTo(map);
                                })
                                .catch((error) =>
                                    console.error(
                                        'Error loading GeoJSON:',
                                        error
                                    )
                                );
                        })
                        .catch((error) => {
                            console.error(
                                'Error fetching barangay data:',
                                error
                            );
                            alert('Failed to load barangay data.');
                        });

                    fetch('/getBarangayData')
                        .then((response) => {
                            if (!response.ok) {
                                throw new Error(
                                    'Failed to fetch barangay data'
                                );
                            }
                            return response.json();
                        })
                        .then((data) => {
                            const yearlyTrendData = data.yearlyTrendData;

                            const barChartData = [
                                { name: 'Solo Parent', data: [] },
                                { name: 'AICS', data: [] },
                                { name: 'VAW', data: [] },
                                { name: 'VAC', data: [] },
                                { name: 'CAR', data: [] },
                                { name: 'CICL', data: [] },
                            ];

                            yearlyTrendData.forEach((trend) => {
                                barChartData[0].data.push(
                                    trend.solo_parent_count
                                );
                                barChartData[1].data.push(trend.aics_count);
                                barChartData[2].data.push(trend.vaw_count);
                                barChartData[3].data.push(trend.vac_count);
                                barChartData[4].data.push(trend.car_count);
                                barChartData[5].data.push(trend.cicl_count);
                            });

                            if (typeof barChart !== 'undefined') {
                                barChart.destroy();
                            }

                            // Initialize a new bar chart with the default data
                            const barOptions = {
                                chart: {
                                    type: 'bar',
                                    height: 250,
                                },
                                series: barChartData,
                                xaxis: {
                                    categories: yearlyTrendData.map(
                                        (trend) => trend.year
                                    ),
                                },
                            };

                            barChart = new ApexCharts(
                                document.querySelector('#barChart'),
                                barOptions
                            );
                            barChart.render();
                        })
                        .catch((error) => {
                            console.error(
                                'Error fetching barangay data:',
                                error
                            );
                            alert('Failed to load barangay data.');
                        });
                });

            fetch('/getBarangayData')
                .then((response) => response.json())
                .then((data) => {
                    const sexDistribution = data.sexDistribution;

                    const pieData = [
                        Number(sexDistribution.male_count),
                        Number(sexDistribution.female_count),
                        Number(sexDistribution.children_count),
                        Number(sexDistribution.senior_count),
                    ];

                    var pieOptions = {
                        chart: { type: 'pie', height: 400 },
                        series: pieData,
                        labels: [
                            'Male',
                            'Female',
                            'Children (<18)',
                            'Senior Citizen (>60)',
                        ],
                    };

                    new ApexCharts(
                        document.querySelector('#pieChart'),
                        pieOptions
                    ).render();
                })
                .catch((error) => {
                    console.error('Error fetching data:', error);
                });
        })
        .catch((error) => {
            console.error('Error fetching barangay data:', error);
            alert('Failed to load barangay data.');
        });
});
