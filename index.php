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

    <!-- Bootstraps ikoner -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon: https://favicon.io/favicon-converter/ -->
    <link rel="apple-touch-icon" sizes="180x180" href="img/logo/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/logo/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/logo/favicons/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

</head>
<body>

<!--------------- HEADER --------------->
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
            <a href="map.php" class="btn rounded-4 btn-secondary px-5 py-2 fw-semibold text-white h-btn">
                Åben kort
            </a>
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

            <!-- Plads filter knap -->
            <div class="btn btn-outline-secondary text-dark border bg-white rounded-pill d-flex align-items-center gap-2 flex-shrink-0 h-cursor-pointer">
                <div class="bi bi bi-box-fill fs-5"></div>Plads</div>
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


<!--------------- NAVBAR --------------->
<?php include 'components/navigation.php'; ?>
<!--------------- NAVBAR --------------->


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

            // Sorter markings: grøn (success) -> gul (warning) -> rød (danger)
            sted.markings.sort(function(a, b) {
                // Vi definerer en rækkefølge/værdi for hver farve
                const colorOrder = {
                    "success": 1,
                    "succes": 1, // Tager højde for slåfejlen i din JSON
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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
