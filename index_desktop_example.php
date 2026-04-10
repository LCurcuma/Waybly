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

    <title>Waybly</title>

    <meta name="robots" content="All">
    <meta name="author" content="Udgiver">
    <meta name="copyright" content="Information om copyright">

    <link href="css/styles.css" rel="stylesheet" type="text/css">
    <link href="css/map_styles.css" rel="stylesheet" type="text/css">

    <!-- Bootstraps ikoner -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon: https://favicon.io/favicon-converter/ -->
    <link rel="apple-touch-icon" sizes="180x180" href="img/logo/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/logo/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/logo/favicons/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <!--Den SKAL være her for kort-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin=""/>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>
    <!--Den SKAL være her for kort-->
</head>
<body>

<!--------------- HEADER --------------->
<div class="container min-vw-100 min-vh-100">
    <div class="row">
        <div class="col-4">
            <!--index.html-->
            <div class="h-container">
                <div class="h-header px-3 pt-4 pb-4 bg-primary">

                    <!-- Logo i venstre side -->
                    <div class="row align-items-center mb-3">
                        <div class="col-3">
                            <img src="img/logo/midwlogo.png" alt="Logo" class="h-logo">
                        </div>

                        <!-- Velkommen i midten -->
                        <div class="col-6 text-center">
                            <div class="h2 text-white mb-0 fw-bold">Velkommen!</div>
                        </div>
                    </div>

                    <!-- søgefelt -->
                    <div class="input-group mb-3 mt-4 rounded-4 h-search-bar">
                        <div class="input-group-text bg-white border-0"><div class="bi bi-search text-muted"></div></div>
                        <input type="text" class="form-control border-0 shadow-none" placeholder="Søg på steder!">
                        <div class="input-group-text bg-white border-0"><div class="bi bi-mic text-muted"></div></div>
                    </div>

                    <!-- Knap til kort -->
                    <div class="d-flex mt-4 justify-content-center">
                        <div class="btn rounded-4 btn-secondary px-5 py-2 fw-semibold text-white">Åben kort</div>
                    </div>
                </div>
            </div>
            <!--------------- HEADER --------------->


            <!----------- FILTER SECTION ----------->
            <div class="px-3 pt-4">
                <div class="mb-4">
                    <div class="h4 fw-bold mb-3">Populære søgninger</div>
                    <div class="d-flex gap-2 overflow-x-auto h-hide-scrollbar pb-2">

                        <!-- Rampe filter knap -->
                        <div class="btn btn-outline-secondary text-dark border bg-white rounded-pill d-flex align-items-center gap-2 flex-shrink-0 h-cursor-pointer">
                            <div class="bi bi-person-wheelchair fs-5"></div>Rampe</div>

                        <!-- Toilet filter knap -->
                        <div class="btn btn-outline-secondary text-dark border bg-white rounded-pill d-flex align-items-center gap-2 flex-shrink-0 h-cursor-pointer">
                            <div class="bi bi-badge-wc-fill fs-5"></div>Toilet</div>

                        <!-- Parkering filter knap -->
                        <div class="btn btn-outline-secondary text-dark border bg-white rounded-pill d-flex align-items-center gap-2 flex-shrink-0 h-cursor-pointer">
                            <div class="bi bi-p-square-fill fs-5"></div>Parkering</div>

                        <!-- Dør filter knap -->
                        <div class="btn btn-outline-secondary text-dark border bg-white rounded-pill d-flex align-items-center gap-2 flex-shrink-0 h-cursor-pointer">
                            <div class="bi bi-door-open-fill fs-5"></div>Dør</div>
                    </div>
                </div>
            </div>
            <!----------- FILTER SECTION ----------->


            <!---------------- CARDS --------------->
            <div class="px-3">
                <div class="mb-4">
                    <div class="h5 fw-bold mb-3">Steder tæt på dig</div>
                    <div class="d-flex gap-3 overflow-x-auto h-hide-scrollbar pb-2" id="places-container"></div>
                </div>

                <div class="mb-5 pb-5">
                    <div class="h5 fw-bold mb-3">Seneste anmeldelser</div>
                    <div class="d-flex gap-3 overflow-x-auto h-hide-scrollbar pb-2" id="reviews-container"></div>
                </div>
            </div>
            <!---------------- CARDS --------------->


        </div>

        <!--index.html-->

        <!--map.html-->
        <div class="col-8">
            <div id="map"></div>
        </div>
        <!--map.html-->
    </div>
</div>

<!--fra index.html-->
<!----------- CARDS JS SCRIPT ---------->
<script>
    // Når siden er klar
    document.addEventListener('DOMContentLoaded', start);

    function start() {
        hentData();
    }

    // Hent JSON data
    async function hentData() {
        try {
            const response = await fetch('data/places.json');

            if (!response.ok) {
                console.error("Kunne ikke finde JSON filen");
                return;
            }

            const data = await response.json();

            // Vis kort begge steder
            tegnKort(data, 'places-container');
            tegnKort(data, 'reviews-container');

        } catch (error) {
            console.error("Fejl:", error);
        }
    }

    // Lav kortene
    function tegnKort(liste, containerId) {

        const container = document.getElementById(containerId);

        if (!container) return;

        container.innerHTML = '';

        // Loop gennem alle steder
        liste.forEach(function(sted) {

            // rating/stjerner
            let stjerner = '';
            const rating = parseFloat(sted.rating);

            for (let i = 1; i <= 5; i++) {

                if (i <= Math.floor(rating)) {
                    stjerner += '<i class="bi bi-star-fill text-info"></i>';

                } else if (i === Math.ceil(rating) && rating % 1 !== 0) {
                    stjerner += '<i class="bi bi-star-half text-info"></i>';

                } else {
                    stjerner += '<i class="bi bi-star text-info"></i>';
                }
            }

            // tags
            let tags = '';

            sted.markings.forEach(function(m) {

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

            // laver cards
            const kort = `
            <div class="h-place-card flex-shrink-0 mb-3" style="width: 260px;">

                <img src="${sted.photo_links[0]}" class="h-card-img">

                <div class="p-3">

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="fw-bold text-nowrap overflow-hidden" style="text-overflow: ellipsis; max-width: 140px;">
                            ${sted.name}
                        </div>

                        <div class="small d-flex align-items-center gap-1">
                            <span>${stjerner}</span>
                            <span class="fw-bold">${sted.rating}</span>
                        </div>
                    </div>

                    <div class="h-description-text mt-1 mb-2">
                        ${sted.description}
                    </div>

                    <div class="d-flex flex-wrap gap-1">
                        ${tags}
                    </div>
                </div>
            </div>
        `;

            // Tilføj til siden
            container.innerHTML += kort;
        });
    }
</script>
<!----------- CARDS JS SCRIPT ---------->
<!--fra index.html-->

<!--fra map.html-->
<!--KORT-->
<script>
    //den laver kort, som viser kort på lokationen, som er 54, 11 med zoom 16
    var map = L.map('map').setView([54.7646137,11.8709918], 16);

    //den tage kortet fra nettet. Uden det vises kortet ikke
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    //tilføje container med burger menu og hjerte knapper
    var customControl = L.Control.extend({
        options: {
            position: 'topright'
        },

        onAdd: function () {
            var container = L.DomUtil.create('div', 'btn-cont');
            let isClicked = false;


            container.innerHTML = `<button class="burger-btn" id="burger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/></svg></button><div id="burger_menu" class="burgerMenu hidden"><a href="index.html">Tilbage</a><a href="">Kontakt</a></div> <button class="burger-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16"> <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/></svg></button>`;

            //tilføje funktion for at fjerne eller vise burger menuen
            let burgerMenu = container.querySelector('#burger_menu');
            let burgerButton = container.querySelector('#burger');

            burgerButton.addEventListener('click', () => {
                burgerMenu.classList.toggle('hidden');
            })

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
<!--fra map.html-->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
