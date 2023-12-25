document.getElementById('select-location').addEventListener('change', function(e) {
    let coords = e.target.value.split(",");
    let lat = parseFloat(coords[0]);
    let lng = parseFloat(coords[1]);

    map.flyTo([lat, lng], 17);
});