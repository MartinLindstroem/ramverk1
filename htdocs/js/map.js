// Set up leaflet to display OpenStreetMap

(function() {
    let lat;
    let long;
    let map;

    if (result) {
        if (result.latitude && result.longitude) {
            lat = result.latitude;
            long = result.longitude;
    
            map = L.map('mapid').setView([lat, long], 10);
        } else {
            map = L.map('mapid').setView([40, 15], 2);
        }
    } else {
        map = L.map('mapid').setView([40, 15], 2);
    }

    L.tileLayer(`https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=${token}`, {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: token,
}).addTo(map);


    if (lat && long) {
        setTimeout(function() {
            var marker = L.marker([lat, long]).addTo(map);
        }, 500)
    }
})();