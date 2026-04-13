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
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Stylesheet -->
    <link href="css/styles.css" rel="stylesheet" type="text/css">
    <link href="css/map_styles.css" rel="stylesheet" type="text/css">

    <!-- Font Awesome ikoner -->
    <script src="https://kit.fontawesome.com/737b386bab.js" crossorigin="anonymous"></script>

    <!-- Bootstraps ikoner -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- AOS - Animate On Scroll Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Favicon: https://favicon.io/favicon-converter/ -->
    <link rel="apple-touch-icon" sizes="180x180" href="img/logo/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/logo/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/logo/favicons/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">


    <!-- Map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin="">
    </script>

</head>

<body>

<!---- MOBIL-/TABLETVERSION AF INDEX.PHP ---->
<div class="d-block d-lg-none">


    <!--------------- HEADER MOBIL --------------->
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
                <div class="input-group-text bg-white border-0">
                    <div class="bi bi-search text-muted"></div>
                </div>

                <label>
                    <input type="text" class="form-control border-0 shadow-none" placeholder="Søg på steder!">
                </label>

                <div class="input-group-text bg-white border-0">
                    <div class="bi bi-mic text-muted"></div>
                </div>
            </div>

            <!-- Knap til kort -->
            <div class="d-flex mt-4 justify-content-center">
                <a href="map.php" class="btn rounded-4 btn-secondary px-5 py-2 fw-semibold text-white h-btn">
                    Åben kort
                </a>
            </div>
        </div>
    </div>
    <!--------------- HEADER MOBIL --------------->


    <!----------- FILTER SECTION MOBIL ----------->
    <div class="px-3 pt-4">

        <div data-aos="fade-up">
            <div class="mb-4">

                <div class="h4 fw-bold mb-3">Populære søgninger</div>
                <div class="d-flex gap-2 overflow-x-auto h-hide-scrollbar pb-2">

                    <!-- Rampe filter knap -->
                    <div class="btn btn-outline-secondary text-dark border bg-white rounded-pill d-flex align-items-center gap-2 flex-shrink-0 h-cursor-pointer">
                        <div class="bi bi-person-wheelchair fs-5"></div>Rampe
                    </div>

                    <!-- Toilet filter knap -->
                    <div class="btn btn-outline-secondary text-dark border bg-white rounded-pill d-flex align-items-center gap-2 flex-shrink-0 h-cursor-pointer">
                        <div class="bi bi-badge-wc-fill fs-5"></div>Toilet
                    </div>

                    <!-- Parkering filter knap -->
                    <div class="btn btn-outline-secondary text-dark border bg-white rounded-pill d-flex align-items-center gap-2 flex-shrink-0 h-cursor-pointer">
                        <div class="bi bi-p-square-fill fs-5"></div>Parkering
                    </div>

                    <!-- Dør filter knap -->
                    <div class="btn btn-outline-secondary text-dark border bg-white rounded-pill d-flex align-items-center gap-2 flex-shrink-0 h-cursor-pointer">
                        <div class="bi bi-door-open-fill fs-5"></div>Dør
                    </div>

                    <!-- Plads filter knap -->
                    <div class="btn btn-outline-secondary text-dark border bg-white rounded-pill d-flex align-items-center gap-2 flex-shrink-0 h-cursor-pointer">
                        <div class="bi bi bi-box-fill fs-5"></div>Plads
                    </div>

                </div>

            </div>
        </div>

    </div>
    <!----------- FILTER SECTION MOBIL ----------->


    <!---------------- CARDS MOBIL --------------->
    <div class="px-3">

        <div data-aos="fade-up">
            <div class="mb-4">
                <div class="h5 fw-bold mb-3">Steder tæt på dig</div>
                <div class="d-flex gap-3 overflow-x-auto h-hide-scrollbar pb-2" id="places-container"></div>
            </div>
        </div>

        <div data-aos="fade-up">
            <div class="mb-5 pb-5">
                <div class="h5 fw-bold mb-3">Bedste anmeldelser</div>
                <div class="d-flex gap-3 overflow-x-auto h-hide-scrollbar pb-2" id="reviews-container"></div>
            </div>
        </div>

    </div>
    <!---------------- CARDS MOBIL --------------->


    <!--------------- NAVBAR MOBIL --------------->
        <div class="d-block d-lg-none position-fixed bottom-0 start-0 w-100 bg-primary px-5 mx-0 my-0 py-0">
            <?php include 'components/navigation.php'; ?>
        </div>
    <!--------------- NAVBAR MOBIL --------------->


    <!----------- CARDS JS SCRIPT MOBIL ----------->
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

                //Vis kortene usorteret i "Steder tæt på dig"
                tegnKort(data, 'places-container');

                // Lav en kopi af dataen, så vi ikke ødelægger den originale rækkefølge
                const sorteretData = [...data];

                // 3. Sorter kopien efter rating (højeste tal først)
                sorteretData.sort(function (a, b) {
                    return parseFloat(b.rating) - parseFloat(a.rating);
                });

                // 4. Vis de sorterede kort i "Seneste anmeldelser"
                tegnKort(sorteretData, 'reviews-container');

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
            liste.forEach(function (sted) {

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

                // Sorter markings: grøn (success) -> gul (warning) -> rød (danger)
                sted.markings.sort(function (a, b) {

                    // Vi definerer en rækkefølge/værdi for hver farve
                    const colorOrder = {
                        "success": 1,
                        "warning": 2,
                        "danger": 3
                    };

                    // Hent værdien for a og b (sæt til 4, hvis statussen er ukendt)
                    const weightA = colorOrder[a.status] || 4;
                    const weightB = colorOrder[b.status] || 4;

                    // Sorter laveste tal først
                    return weightA - weightB;
                });

                // tags
                let tags = '';

                sted.markings.forEach(function (m) {

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
            <div class="h-place-card flex-shrink-0 mb-3"
                style="width: 260px; ${sted.link ? 'cursor:pointer;' : ''}"
                onclick="${sted.link ? `window.location.href='${sted.link}'` : ''}">

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
    <!----------- CARDS JS SCRIPT MOBIL ----------->


</div>
<!---- MOBIL-/TABLETVERSION AF INDEX.PHP ---->


<!---- TABLET-/DESKTOPVERSION AF INDEX.PHP ---->
<div class="d-none d-lg-block">

    <div class="container min-vw-100 min-vh-100">
        <div class="row">
            <div class="col-4 px-0 mx-0">


                <!------------ HEADER DESKTOP ------------>
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

                    </div>
                </div>
                <!------------ HEADER DESKTOP ------------>


                <!-------- FILTER SECTION DESKTOP -------->
                <div class="px-3 pt-4">
                    <div class="mb-4">

                        <div class="h4 fw-bold mb-3">Populære søgninger</div>
                        <div class="d-flex gap-2 overflow-x-auto h-hide-scrollbar pb-2">

                            <!-- Rampe filter knap -->
                            <div class="btn btn-outline-secondary text-dark border bg-white rounded-pill d-flex align-items-center gap-2 flex-shrink-0 h-cursor-pointer">
                                <div class="bi bi-person-wheelchair fs-5"></div>Rampe
                            </div>

                            <!-- Toilet filter knap -->
                            <div class="btn btn-outline-secondary text-dark border bg-white rounded-pill d-flex align-items-center gap-2 flex-shrink-0 h-cursor-pointer">
                                <div class="bi bi-badge-wc-fill fs-5"></div>Toilet
                            </div>

                            <!-- Parkering filter knap -->
                            <div class="btn btn-outline-secondary text-dark border bg-white rounded-pill d-flex align-items-center gap-2 flex-shrink-0 h-cursor-pointer">
                                <div class="bi bi-p-square-fill fs-5"></div>Parkering
                            </div>

                            <!-- Dør filter knap -->
                            <div class="btn btn-outline-secondary text-dark border bg-white rounded-pill d-flex align-items-center gap-2 flex-shrink-0 h-cursor-pointer">
                                <div class="bi bi-door-open-fill fs-5"></div>Dør
                            </div>

                            <!-- Plads knap -->
                            <div class="btn btn-outline-secondary text-dark border bg-white rounded-pill d-flex align-items-center gap-2 flex-shrink-0 h-cursor-pointer">
                                <div class="bi bi bi-box-fill fs-5"></div>Plads
                            </div>

                        </div>

                    </div>
                </div>
                <!-------- FILTER SECTION DESKTOP -------->


                <!------------- CARDS DESKTOP ------------>
                <div class="px-3">
                    <div class="mb-4">
                        <div class="h5 fw-bold mb-3">Steder tæt på dig</div>
                        <div class="d-flex gap-3 w-100 overflow-x-auto h-hide-scrollbar pb-2"
                             id="places-container_desktop"></div>
                    </div>

                    <div class="mb-5 pb-5">
                        <div class="h5 fw-bold mb-3">Seneste anmeldelser</div>
                        <div class="d-flex gap-3 w-100 overflow-x-auto h-hide-scrollbar pb-2"
                             id="reviews-container_desktop"></div>
                    </div>
                </div>
                <!------------- CARDS DESKTOP ------------>

                </div>

                <!--index.html-->

                <!--map.html-->
                <div class="col-8 position-fixed top-0 end-0">
                    <!-- søgefelt -->
                    <div class="input-group mb-3 mt-3 h-search-bar">
                        <div class="input-group-text bg-white border-0">
                            <div class="bi bi-search text-muted"></div>
                        </div>
                        <input type="text" class="form-control border-0 shadow-none" placeholder="Søg på steder!">
                        <div class="input-group-text bg-white border-0">
                            <div class="bi bi-mic text-muted"></div>
                        </div>
                    </div>

                    <div id="map"></div>
                </div>
                <!--map.html-->
            </div>
        </div>
    </div>


    <!--fra map.html-->
    <!--KORT-->
    <script>
        //den laver kort, som viser kort på lokationen, som er 54, 11 med zoom 16
        var map = L.map('map').setView([54.7646137, 11.8709918], 16);

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


                container.innerHTML = `<button class="burger-btn" id="burger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/></svg></button><div id="burger_menu" class="burgerMenu hidden"><a href="">Kontakt</a></div> <button class="burger-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16"> <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/></svg></button>`;

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
        document.addEventListener('DOMContentLoaded', hentData_map);

        // Hent JSON data
        async function hentData_map() {
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

                    // Sorter markings: grøn (success) -> gul (warning) -> rød (danger)
                    place.markings.sort(function (a, b) {

                        // Vi definerer en rækkefølge/værdi for hver farve
                        const colorOrder = {
                            "success": 1,
                            "warning": 2,
                            "danger": 3
                        };

                        // Hent værdien for a og b (sæt til 4, hvis statussen er ukendt)
                        const weightA = colorOrder[a.status] || 4;
                        const weightB = colorOrder[b.status] || 4;

                        // Sorter laveste tal først
                        return weightA - weightB;
                    });

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
${place.link !== "" ? `
                    <div class="links">
                    <a href="${place.link}" class="link_detaljer" onclick="openDetailsModal(event)">Se detaljer</a>
                    <a href="rapport.php" class="link_rapport" onclick="openDetailsModal(event)">+</a>
                    </div>
` : ""}

</div>
    `);
                });
            } catch (error) {
                console.error("Fejl:", error);
            }
        }

    </script>




    <!--SCRIPT FOR DESKTOP VERSION AF APP-->
    <!----------- CARDS JS SCRIPT ---------->
    <script>
        // Når siden er klar
        document.addEventListener('DOMContentLoaded', start_desktop);

        function start_desktop() {
            hentData_desktop();
        }

        // Hent JSON data
        async function hentData_desktop() {
            try {
                const response = await fetch('data/places.json');

                if (!response.ok) {
                    console.error("Kunne ikke finde JSON filen");
                    return;
                }

                const data = await response.json();

                // Vis kort begge steder
                tegnKort_desktop(data, 'places-container_desktop');

                // Lav en kopi af dataen, så vi ikke ødelægger den originale rækkefølge
                const sorteretData_desktop = [...data];

                // 3. Sorter kopien efter rating (højeste tal først)
                sorteretData_desktop.sort(function (a, b) {
                    return parseFloat(b.rating) - parseFloat(a.rating);
                });

                // 4. Vis de sorterede kort i "Seneste anmeldelser"
                tegnKort_desktop(sorteretData_desktop, 'reviews-container_desktop');


            } catch (error) {
                console.error("Fejl:", error);
            }
        }

        // Lav kortene
        // Lav kortene (Desktop)
        function tegnKort_desktop(liste, containerId) {

            const container = document.getElementById(containerId);

            if (!container) return;

            container.innerHTML = '';

            // Loop gennem alle steder
            liste.forEach(function (sted) {

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

                // Sorter markings: grøn (success) -> gul (warning) -> rød (danger)
                sted.markings.sort(function (a, b) {

                    // Vi definerer en rækkefølge/værdi for hver farve
                    const colorOrder = {
                        "success": 1,
                        "warning": 2,
                        "danger": 3
                    };

                    // Hent værdien for a og b (sæt til 4, hvis statussen er ukendt)
                    const weightA = colorOrder[a.status] || 4;
                    const weightB = colorOrder[b.status] || 4;

                    // Sorter laveste tal først
                    return weightA - weightB;
                });

                // tags
                let tags = '';

                sted.markings.forEach(function (m) {

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


                // Gør så "netto" cardet i desktop åbner leylas popup istedet for details.php
                let onClickAction = "";
                let cursorStyle = "";

                if (sted.name.toLowerCase() === "netto") {
                    // Åbn modal, hvis stedet er Netto
                    onClickAction = "document.getElementById('detailsModal').style.display='block'";
                    cursorStyle = "cursor:pointer;";
                } else if (sted.link) {
                    // Gå til linket, hvis det er alle andre steder
                    onClickAction = `window.location.href='${sted.link}'`;
                    cursorStyle = "cursor:pointer;";
                }


                // laver cards
                const kort_desktop = `
        <div class="h-place-card flex-shrink-0 mb-3" style="width: 260px; ${cursorStyle}"
            onclick="${onClickAction}">

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
                container.innerHTML += kort_desktop;
            });
        }
    </script>
    <!----------- CARDS JS SCRIPT ---------->
    <!--fra index.html-->


    <!------------ AOS LIBRARY ------------>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <!------------ AOS LIBRARY ------------>



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
                                        <path id="Union" fill="#f9feff"
                                              d="M20.4961 15.877c0.6666 -0.3888 1.5039 0.0925 1.5039 0.8642V21c0 0.5523 -0.4477 1 -1 1h-9.1504c-0.5104 0 -0.6928 -0.6745 -0.2519 -0.9316zM5.00684 13.7051c0.25879 -0.4876 0.86376 -0.6736 1.35156 -0.4151 0.48781 0.2588 0.67368 0.8647 0.41504 1.3526 -0.18406 0.3474 -0.28902 0.7442 -0.28906 1.1679 0.00026 1.3805 1.11945 2.5 2.5 2.5 1.33472 0 2.42552 -1.0467 2.49612 -2.3632 0.0294 -0.5514 0.5004 -0.9746 1.0517 -0.9453 0.5515 0.0294 0.9747 0.5003 0.9453 1.0517 -0.1269 2.3725 -2.0895 4.2568 -4.49312 4.2568 -2.48512 0 -4.49974 -2.0149 -4.5 -4.5 0.00004 -0.7583 0.18904 -1.4763 0.52246 -2.1054m0.97461 -6.60256c1.05573 -0.6095 2.31379 0.30618 3.41699 0.47168 1.21886 0.18279 2.35076 0.11497 3.00196 -0.37305 0.4418 -0.33123 1.0681 -0.24158 1.3994 0.2002 0.3307 0.44178 0.2414 1.06823 -0.2002 1.39941 -1.2342 0.92523 -2.9034 0.94402 -4.15917 0.79395l1.54787 2.67967 2.1455 -1.2373c0.9565 -0.5522 2.1801 -0.2249 2.7324 0.7315l1.8662 3.2324c0.2754 0.4781 0.1118 1.0902 -0.3662 1.3662 -0.478 0.2757 -1.0899 0.1114 -1.3662 -0.3662l-1.8662 -3.2324L10.5 14.8672c-0.82599 0.4763 -1.95041 0.1836 -2.42773 -0.6426L5.34082 9.49316c-0.4831 -0.83688 -0.19609 -1.9073 0.64063 -2.39062M4.75 3c0.9665 0 1.75 0.7835 1.75 1.75S5.7165 6.5 4.75 6.5 3 5.7165 3 4.75 3.7835 3 4.75 3"
                                              stroke-width="1"></path>
                                    </g>
                                </svg>
                                <span class="statusoverskrift px-1">Rampe</span>
                            </div>

                            <div class="dropdown-menu p-3 statuspopup">
                                Intet behov for rampe, da der er ingen forhindringer!
                            </div>
                        </div>

                        <div class="dropdown">
                            <div class="statusbox status-ok has-tooltip" data-bs-toggle="dropdown" data-bs-boundary="viewport" data-bs-auto-close="outside">
                                <i class="statusicon bi bi-door-closed-fill ps-2"></i>
                                <span class="statusoverskrift px-1 pe-2">Dør</span>
                            </div>

                            <div class="dropdown-menu  p-3 statuspopup">
                                Super bred dør, med adgang til kørestol osv.!
                            </div>
                        </div>


                        <div class="dropdown">
                            <div class="statusbox status-warning" data-bs-toggle="dropdown" data-bs-boundary="viewport" data-bs-auto-close="outside">
                                <i class="statusicon fa-solid fa-wheelchair ps-2"></i>
                                <span class="statusoverskrift px-1 pe-2">Toilet</span>
                            </div>

                            <div class="dropdown-menu p-3 statuspopup">
                                Intet toilet til kunder af butikken.
                            </div>
                        </div>

                        <div class="dropdown">
                            <div class="statusbox status-ok" data-bs-toggle="dropdown" data-bs-boundary="viewport" data-bs-auto-close="outside">
                                <i class="statusicon bi bi-box-seam ps-2"></i>
                                <span class="statusoverskrift px-1 pe-2">Plads</span>
                            </div>

                            <div class="dropdown-menu p-3 statuspopup">
                                Der er meget god plads!
                            </div>
                        </div>

                        <div class="dropdown">
                            <div class="statusbox status-ok" data-bs-toggle="dropdown" data-bs-boundary="viewport" data-bs-auto-close="outside">
                                <i class="statusicon fa-solid fa-square-parking ps-2"></i>
                                <span class="statusoverskrift px-1 pe-2">Parkering</span>
                            </div>

                            <div class="dropdown-menu  p-3 statuspopup">
                                Mange parkeringspladser!
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
                <div class="bottom-shadow-hint"></div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>