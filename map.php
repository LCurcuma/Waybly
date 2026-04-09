<?php
/**
 * @var db $db
 */

require "settings/init.php";
?>
<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="utf-8">

    <title>Sigende titel</title>

    <meta name="robots" content="All">
    <meta name="author" content="Udgiver">
    <meta name="copyright" content="Information om copyright">

    <link href="css/styles.css" rel="stylesheet" type="text/css">
    <link href="css/map_styles.css" rel="stylesheet" type="text/css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon: https://favicon.io/favicon-converter/ -->
    <link rel="apple-touch-icon" sizes="180x180" href="img/logo/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/logo/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/logo/favicons/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin=""/>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>
</head>

<body style="bg-white">
<!--Tilbage knap
<a href="index.php" class="back-btn">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/></svg>
</a>
-->
<!--Kort kontainer-->
<div id="map"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    //den laver kort, som viser kort på lokationen, som er 54, 11 med zoom 16
    var map = L.map('map').setView([54.7646137,11.8709918], 16);

    //den tage kortet fra nettet. Uden det vises kortet ikke
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    //tilføje tilbage-knap
    var customControl = L.Control.extend({
        options: {
            position: 'topleft'
        },

        onAdd: function () {
            var container = L.DomUtil.create('div');

            container.innerHTML = '<a href="index.php" class="back-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/></svg></a>';

            // Prevent map from capturing clicks
            L.DomEvent.disableClickPropagation(container);

            return container;
        }
    });

    map.addControl(new customControl());

    //tilføje container med burger menu og hjerte knapper
    var customControl = L.Control.extend({
        options: {
            position: 'topright'
        },

        onAdd: function () {
            var container = L.DomUtil.create('div', 'btn-cont');

            container.innerHTML = '<button class="burger-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/></svg></button> <button class="burger-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16"> <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/></svg></button>';

            // Prevent map from capturing clicks
            L.DomEvent.disableClickPropagation(container);

            return container;
        }
    });

    map.addControl(new customControl());

    // Når siden er klar
    document.addEventListener('DOMContentLoaded', hentData);

    // Hent JSON data
    async function hentData() {
        try {
            const response = await fetch('data/places.json');

            if (!response.ok) {
                console.error("Kunne ikke finde JSON filen");
                return;
            }

            const data = await response.json();

            data.forEach((place) => {

                // Stjerne
                let stjerner = '';
                const rating = parseFloat(place.rating);

                for (let i = 1; i <= 5; i++) {
                    if (i <= Math.floor(rating)) {
                        stjerner += '<i class="bi bi-star-fill text-info"></i>';
                    } else if (i === Math.ceil(rating) && rating % 1 !== 0) {
                        stjerner += '<i class="bi bi-star-half text-info"></i>';
                    } else {
                        stjerner += '<i class="bi bi-star text-info"></i>';
                    }
                }



                // Markeringer
                let tags = '';

                place.markings.forEach(function(m) {

                    let tekstFarve;

                    if (m.status === "warning") {
                        tekstFarve = "text-dark";
                    } else {
                        tekstFarve = "text-white";
                    }

                    tags += `
            <div class="badge bg-${m.status} ${tekstFarve} me-1" style="border-radius: 6px;">
                ${m.navn}
            </div>
        `;
                });

                //Custom marker

                const customIcon = L.divIcon({
                    className: 'custom-marker',
                    html: `
        <svg xmlns=http://www.w3.org/2000/svg" width="40" height="50" fill="currentColor" class=${place.markerColor} viewBox="0 0 16 16">
          <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
        </svg>
    `,
                    iconSize: [30, 30],
                    iconAnchor: [15, 30] // bottom center
                });

                // Laver marker
                const marker = L.marker(place.latlong, { icon: customIcon }).addTo(map);

                //Laver popup
                marker.bindPopup(`
<div class="d-flex flex-column align-items-center justify-content-center gap-3">
<div class="container">
<div class="row justify-content-center align-items-center">
<div class="col col-8">
<h2 class="fw-bold text-nowrap overflow-hidden h2_text_popup" style="text-overflow: ellipsis; max-width: 140px;">${place.name}</h2>

                    <div class="small d-flex align-items-center gap-1">
                        <span>${stjerner}</span>
                        <span class="fw-bold">${place.rating}</span>
                    </div>
                <div class="h-description-text mt-1 mb-2">
                    ${place.description}
                </div>
                <div class="d-flex flex-wrap gap-1">
                    ${tags}
                </div>
</div>
<div class="col col-4">
            <img src="${place.photo_links[0]}" class="card-image">
</div>
</div>
</div>
<a href="" class="link_detaljer">Se detaljer</a>
</div>
    `);
            });
        } catch (error) {
            console.error("Fejl:", error);
        }
    }

</script>
</body>
</html>
