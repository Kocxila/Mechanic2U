

function initMap() {

    // Create a new map centered on the user's current location
    navigator.geolocation.getCurrentPosition(function (position) {
        var userLocation = { lat: position.coords.latitude, lng: position.coords.longitude };
        var map = L.map('map').setView(userLocation, 14.5);

        // Add a marker for the user's location
        var marker = L.marker(userLocation).addTo(map).bindPopup(position.coords.latitude + ", " + position.coords.longitude).openPopup();

        // Create a custom icon for the marker
        var flagIcon = L.icon({
            iconUrl: '../images/location.svg',
            iconSize: [38, 98], // size of the icon
            iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
            popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
        });

        // Add OpenStreetMap tiles to the map
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
        }).addTo(map);


        var coordinatesInput = document.getElementById("coordinates");
        coordinatesInput.innerHTML = position.coords.latitude + ", " + position.coords.longitude;

        //coordinatesInput.value = position.coords.latitude + ", " + position.coords.longitude;

    });

}

window.onload = function () {
    initMap();
};
