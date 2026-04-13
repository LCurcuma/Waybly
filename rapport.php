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

    <title>Rapport</title>

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

<body class="page-rapport">


    <!-- Header -->
    <div class="r-header">
        <a href="details.php" class="back-btn">
            <i class="bi bi-arrow-left custom-icon"></i>
        </a>
        <h1 class="custom-heading">Rapporter</h1>
    </div>

    <div class="app-wrapper">
        <div class="left-column">

            <!-- Card -->
            <div class="location-card">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="location-info">
                        <h2 class="fw-bold custom-h2">Netto Fejøgade</h2>
                        <div class="rating fw-bold">
                            <i class="bi bi-star-fill" style="color: #00B4D7"></i>
                            <i class="bi bi-star-fill" style="color: #00B4D7"></i>
                            <i class="bi bi-star-fill" style="color: #00B4D7"></i>
                            <i class="bi bi-star-fill" style="color: #00B4D7"></i>
                            <i class="bi bi-star-half" style="color: #00B4D7"></i>
                            <span class="score">4.5</span>
                        </div>
                    </div>
                    <img src="https://image.folketidende.dk/3274311.webp?imageId=3274311&cropw=100.00&croph=100.00&width=2116&height=1208&format=webp"
                        class="location-img" alt="netto">
                </div>
            </div>

            <!-- Checkliste -->
            <div class="section">
                <h3 class="custom-check fw-bold"><img src="img/checklist/check.png" style="width: 20px" alt="check">
                    Checkliste</h3>

                <div class="check-item">
                    <span><img src="img/checklist/rampe.png" style="width: 30px" alt="rampe"> Rampe</span>
                    <div class="icons">
                        <i class="bi bi-emoji-smile happy"></i>
                        <i class="bi bi-emoji-neutral neutral"></i>
                        <i class="bi bi-emoji-frown sad"></i>
                    </div>
                </div>

                <div class="check-item">
                    <span><img src="img/checklist/toilet.png" style="width: 30px" alt="toilet"> Toilet</span>
                    <div class="icons">
                        <i class="bi bi-emoji-smile happy"></i>
                        <i class="bi bi-emoji-neutral neutral"></i>
                        <i class="bi bi-emoji-frown sad"></i>
                    </div>
                </div>

                <div class="check-item">
                    <span><img src="img/checklist/dør.png" style="width: 30px" alt="dør"> Dør</span>
                    <div class="icons">
                        <i class="bi bi-emoji-smile happy"></i>
                        <i class="bi bi-emoji-neutral neutral"></i>
                        <i class="bi bi-emoji-frown sad"></i>
                    </div>
                </div>

                <div class="check-item">
                    <span><img src="img/checklist/parkering.png" style="width: 30px" alt="parkering"> Parkering</span>
                    <div class="icons">
                        <i class="bi bi-emoji-smile happy"></i>
                        <i class="bi bi-emoji-neutral neutral"></i>
                        <i class="bi bi-emoji-frown sad"></i>
                    </div>
                </div>

                <div class="check-item">
                    <span><img src="img/checklist/plads.png" style="width: 30px" alt="plads"> Plads</span>
                    <div class="icons">
                        <i class="bi bi-emoji-smile happy"></i>
                        <i class="bi bi-emoji-neutral neutral"></i>
                        <i class="bi bi-emoji-frown sad"></i>
                    </div>
                </div>

            </div>

            <!-- Bemærkninger -->
            <div class="section">
                <h3><img src="img/checklist/bemærkninger/note.png" style="width: 20px" alt="note"><strong>
                        Bemærkninger</strong><span> (valgfri)</span></h3>
                <textarea id="noteInput" class="custom-textarea"></textarea>
            </div>

            <!-- Upload -->
            <div class="section">
                <h3 class="fw-bold custom-h3"><img src="img/checklist/uploade.png" style="width: 20px" alt="upload">
                    <strong>Upload billede</strong> <span>(valgfri)</span></h3>
                <div class="upload-buttons">
                    <button class="upload-btn">
                        <i class="bi bi-camera"></i>
                        Tag photo
                    </button>
                    <button class="upload-btn">
                        <i class="bi bi-upload"></i>
                        Upload photo
                    </button>
                </div>
            </div>

            <!-- Submit -->
            <button id="submitBtn" class="submit-btn" data-bs-toggle="modal" data-bs-target="#successModal">Indsend
                rapport</button>

            <div class="modal fade" id="successModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content success-modal text-center">

                        <div class="success-icon">
                            ✓
                        </div>

                        <h2 class="success-title">Tak!</h2>
                        <p class="success-text">Din rapport er nu indsendt og modtaget af vores team.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>






            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

            <script>
                document.querySelectorAll('.icons i').forEach(icon => {
                    icon.addEventListener('click', function () {
                        let parent = this.parentElement;

                        parent.querySelectorAll('i').forEach(i => i.classList.remove('active'));
                        this.classList.add('active');
                    });
                });

                var modal = document.getElementById('successModal');
                modal.addEventListener('shown.bs.modal', function () {
                    setTimeout(() => {
                        bootstrap.Modal.getInstance(modal).hide();
                    }, 3000);
                });

                document.querySelectorAll('.upload-btn').forEach(btn => {
                    btn.addEventListener('click', () => {
                        alert('funktion kommer snart');
                    });
                });

                document.getElementById('submitBtn').addEventListener('click', function () {

                    // Ryd textarea
                    document.getElementById('noteInput').value = '';

                    // Fjern valgte emojis (active class)
                    document.querySelectorAll('.icons i').forEach(icon => {
                        icon.classList.remove('active');
                    });

                });

            </script>

</body>

</html>