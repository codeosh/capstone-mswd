// public\js\map.js
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
