<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<div class="map-container" style="position: relative; z-index: 0; width: 100%; height:450px; ">
    <div id="loadbox" class="homepage-loadbox"><div class="loading big"></div></div>
    <div id="map" style="position: relative; z-index: 0; width: 100%; height:100%; border:1px solid #ccc; border-radius: 20px;"></div>
</div>



<script>
    const map           = L.map('map').setView([{{ $group->location->lat }}, {{ $group->location->lng }}], 11);
    const markersLoc    = {!! json_encode($markers, 1) !!};
console.log(markersLoc);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    const LeafIcon = L.Icon.extend({
        options: {
            shadowUrl: '/images/icons/car.svg',
            iconSize:     [30, 30],
            shadowSize:   [],
            iconAnchor:   [22, 22],
            shadowAnchor: [4, 4],
            popupAnchor:  [0, 0]
        }
    });

    const carIcon = new LeafIcon({iconUrl: '/images/icons/car.svg'});
    const groupIcon = new LeafIcon({iconUrl: '/images/icons/group-location.svg'});

    // draw all the cars
    markersLoc.forEach(drawMarkers);

    // draw the group location with a dot
    const mGreen = L.marker([{{ $group->location->lat }}, {{ $group->location->lng }}], {icon: groupIcon}).addTo(map);

    // fit all markers on the map
    markersLoc.push([{{ $group->location->lat }}, {{ $group->location->lng }}])
    const bounds = L.latLngBounds(markersLoc);
    map.fitBounds(bounds);

    function drawMarkers(item) {
        console.log(item.lat + ' / '+ item.lng);
        const mGreen = L.marker([item.lat, item.lng], {icon: carIcon}).addTo(map);
    }


</script>
