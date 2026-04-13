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
    <script src="https://kit.fontawesome.com/737b386bab.js" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon: https://favicon.io/favicon-converter/ -->
    <link rel="apple-touch-icon" sizes="180x180" href="img/logo/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/logo/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/logo/favicons/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
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
        var map = L.map('map').setView([54.7646137, 11.8709918], 16);

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

                    place.markings.forEach(function (m) {

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
<div class="links">
<a href="${place.link}" class="link_detaljer" onclick="openDetailsModal(event)">Se detaljer</a>
<a href="rapport.php" class="link_rapport" onclick="openRepportModal(event)" >+</a>
</div>
</div>
    `);
                });
            } catch (error) {
                console.error("Fejl:", error);
            }
        }

    </script>

    <div id="detailsModal" class="detmodal">
        <div class="detmodalcontent">

            <div class="details">
                <div class="headerimg" style="background-image: url('https://image.folketidende.dk/3274311.webp?imageId=3274311&cropw=100.00&croph=100.00&width=2116&height=1208&format=webp');">
                    <span class="detclosemodalbtn" onclick="closeDetailsModal()">&times;</span>

                </div>

                <div class="infobio">
                    <p class="overskriftbio">Netto</p>
                    <div class="stjernerbio">
                        <i class="bi bi-star-fill" style="color: #00B4D7"></i>
                        <i class="bi bi-star-fill" style="color: #00B4D7"></i>
                        <i class="bi bi-star-fill" style="color: #00B4D7"></i>
                        <i class="bi bi-star-fill" style="color: #00B4D7"></i>
                        <i class="bi bi-star-half" style="color: #00B4D7"></i>
                        <span class="talbio">4.5</span>
                    </div>
                    <p class="tekstbio text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                        eiusmod tempor incididunt ut labore, consectetur adipiscing elit, sed do eiusmod tempor
                        incididunt ut labore, consectetur adipiscing elit</p>
                </div>

                <div class="tilgængelighed">
                    <span class="overskrifttilgænge pb-5">Tilgængelighed</span> <i
                        class="fa-solid fa-universal-access tilgængelighedicon" style="color:#00B4D7;"></i>

                    <div class="statustilgængelighedbokse">
                        <div class="dropdown">
                            <div class="statusbox status-ok px-2" data-bs-toggle="dropdown" aria-expanded="false" id="rampe-trigger" data-bs-boundary="viewport" data-bs-auto-close="outside">
                                <svg class="statusiconsvg" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 26 26">
                                    <g id="disability-ramp-up">
                                        <path id="Union" fill="#121212"
                                              d="M20.4961 15.877c0.6666 -0.3888 1.5039 0.0925 1.5039 0.8642V21c0 0.5523 -0.4477 1 -1 1h-9.1504c-0.5104 0 -0.6928 -0.6745 -0.2519 -0.9316zM5.00684 13.7051c0.25879 -0.4876 0.86376 -0.6736 1.35156 -0.4151 0.48781 0.2588 0.67368 0.8647 0.41504 1.3526 -0.18406 0.3474 -0.28902 0.7442 -0.28906 1.1679 0.00026 1.3805 1.11945 2.5 2.5 2.5 1.33472 0 2.42552 -1.0467 2.49612 -2.3632 0.0294 -0.5514 0.5004 -0.9746 1.0517 -0.9453 0.5515 0.0294 0.9747 0.5003 0.9453 1.0517 -0.1269 2.3725 -2.0895 4.2568 -4.49312 4.2568 -2.48512 0 -4.49974 -2.0149 -4.5 -4.5 0.00004 -0.7583 0.18904 -1.4763 0.52246 -2.1054m0.97461 -6.60256c1.05573 -0.6095 2.31379 0.30618 3.41699 0.47168 1.21886 0.18279 2.35076 0.11497 3.00196 -0.37305 0.4418 -0.33123 1.0681 -0.24158 1.3994 0.2002 0.3307 0.44178 0.2414 1.06823 -0.2002 1.39941 -1.2342 0.92523 -2.9034 0.94402 -4.15917 0.79395l1.54787 2.67967 2.1455 -1.2373c0.9565 -0.5522 2.1801 -0.2249 2.7324 0.7315l1.8662 3.2324c0.2754 0.4781 0.1118 1.0902 -0.3662 1.3662 -0.478 0.2757 -1.0899 0.1114 -1.3662 -0.3662l-1.8662 -3.2324L10.5 14.8672c-0.82599 0.4763 -1.95041 0.1836 -2.42773 -0.6426L5.34082 9.49316c-0.4831 -0.83688 -0.19609 -1.9073 0.64063 -2.39062M4.75 3c0.9665 0 1.75 0.7835 1.75 1.75S5.7165 6.5 4.75 6.5 3 5.7165 3 4.75 3.7835 3 4.75 3"
                                              stroke-width="1"></path>
                                    </g>
                                </svg>
                                <span class="statusoverskrift px-1">Rampe</span>
                            </div>

                            <div class="dropdown-menu p-3 statuspopup">
                                Intet behov for rampe, da der er ingen forhindringer.
                            </div>
                        </div>

                        <div class="dropdown">
                            <div class="statusbox status-ok has-tooltip" data-bs-toggle="dropdown" data-bs-boundary="viewport" data-bs-auto-close="outside">
                                <i class="statusicon bi bi-door-closed-fill ps-2"></i>
                                <span class="statusoverskrift px-1 pe-2">Dør</span>
                            </div>

                            <div class="dropdown-menu  p-3 statuspopup">
                                Super bred dør, med adgang til kørestol osv.
                            </div>
                        </div>


                        <div class="dropdown">
                            <div class="statusbox status-error" data-bs-toggle="dropdown" data-bs-boundary="viewport" data-bs-auto-close="outside">
                                <i class="statusicon fa-solid fa-wheelchair ps-2"></i>
                                <span class="statusoverskrift px-1 pe-2">Toilet</span>
                            </div>

                            <div class="dropdown-menu p-3 statuspopup">
                                Intet toilet til kunder af butikken.
                            </div>
                        </div>


                        <div class="dropdown">
                            <div class="statusbox status-warning" data-bs-toggle="dropdown" data-bs-boundary="viewport" data-bs-auto-close="outside">
                                <i class="statusicon fa-solid fa-square-parking ps-2"></i>
                                <span class="statusoverskrift px-1 pe-2">Parkering</span>
                            </div>

                            <div class="dropdown-menu  p-3 statuspopup">
                                Ikke så mange parkeringspladser.
                            </div>
                        </div>
                    </div>
                </div>


                <div class="kommentarer">
                    <span class="overskriftkommentar pb-5">Kommentarer</span> <i
                        class="fa-solid fa-comments kommentaricon" style="color:#00B4D7;"></i>
                </div>

                <div class="kommentarboks">
                    <div class="kommentarcard">
                        <div class="userinfo">
                            <div class="usercirkel">
                                <i class="bi bi-person-fill" style="color: #01085E"></i>
                            </div>
                            <div class="userdetails">
                                <p class="komusertekst">Brian H.</p>
                                <p class="datotekst text-muted"> ○ I dag</p>
                            </div>
                            <div class="stjernerkom">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                            </div>
                        </div>

                        <div class="statuscheck">
                            <i class="bi bi-check-circle-fill"></i>
                            <span class="statuschecktekst">Super tilgængeligt!</span>
                        </div>

                        <p class="kommentartekst">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        </p>
                    </div>
                </div>


                <div class="kommentarboks">
                    <div class="kommentarcard">
                        <div class="userinfo">
                            <div class="usercirkel">
                                <i class="bi bi-person-fill" style="color: palevioletred"></i>
                            </div>
                            <div class="userdetails">
                                <p class="komusertekst">Mette F.</p>
                                <p class="datotekst text-muted"> ○ I går</p>
                            </div>
                            <div class="stjernerkom">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                            </div>
                        </div>

                        <div class="statuscheck2">
                            <i class="i2 bi bi-check-circle-fill"></i>
                            <span class="statuschecktekst">Okay tilgængeligt</span>
                        </div>

                        <p class="kommentartekst">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                            do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        </p>
                    </div>
                </div>

                <div class="kommentarboks mb-2">
                    <div class="kommentarcard">
                        <div class="userinfo">
                            <div class="usercirkel">
                                <i class="bi bi-person-fill" style="color: blueviolet"></i>
                            </div>
                            <div class="userdetails">
                                <p class="komusertekst">Andreas M.</p>
                                <p class="datotekst text-muted"> ○ I foregårs</p>
                            </div>
                            <div class="stjernerkom">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                            </div>
                        </div>

                        <div class="statuscheck3">
                            <i class="i3 bi bi-check-circle-fill"></i>
                            <span class="statuschecktekst">Forfærdelig tilgængelighed!</span>
                        </div>

                        <p class="kommentartekst">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        </p>
                    </div>
                </div>

                <div class="desktopfooter">
                    <button class="reportbtn" onclick="openRepportModal()">
                        Rapporter
                    </button>
                </div>
            </div>

            <div class="bottom-shadow-hint"></div>
        </div>
    </div>

    <script>
        function openDetailsModal(event) {
            if (window.innerWidth >= 1024) {

                if (event) {
                    event.preventDefault();
                }

                var modal = document.getElementById('detailsModal');
                if (modal) {
                    modal.style.display = 'block';
                    document.body.style.overflow = 'hidden';
                }
            }
        }

        function closeDetailsModal() {
            document.getElementById('detailsModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

    </script>


</body>

</html>