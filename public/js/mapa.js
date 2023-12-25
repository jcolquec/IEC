// Crea un mapa centrado en una ubicación inicial
const map = new google.maps.Map(document.getElementById('mapa'), {
    center: { lat: LATITUD_INICIAL, lng: LONGITUD_INICIAL },
    zoom: 10
});

// Itera sobre las estaciones y crea un marcador para cada una
estaciones.forEach(estacion => {
    const marker = new google.maps.Marker({
        position: { lat: estacion.latitud, lng: estacion.longitud },
        map: map,
        title: estacion.nombre
    });

    // Agrega información adicional al marcador (opcional)
    const infowindow = new google.maps.InfoWindow({
        content: `<div><strong>${estacion.nombre}</strong></div>`
    });

    // Muestra información adicional cuando se hace clic en el marcador
    marker.addListener('click', () => {
        infowindow.open(map, marker);
    });
});