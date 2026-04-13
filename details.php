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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/737b386bab.js" crossorigin="anonymous"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon: https://favicon.io/favicon-converter/ -->
    <link rel="apple-touch-icon" sizes="180x180" href="img/logo/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/logo/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/logo/favicons/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">


</head>

<body style="bg-$white;">


    <div class="details">
        <div class="headerimg"
            style="background-image: url('https://image.folketidende.dk/3274311.webp?imageId=3274311&cropw=100.00&croph=100.00&width=2116&height=1208&format=webp');">
            <a href="index.php">
                <i class="backbtn fa-solid fa-angle-left pt-3 ps-2" style="color: white;"></i>
            </a>
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
            <p class="tekstbio text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                tempor incididunt ut labore, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore,
                consectetur adipiscing elit</p>
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
            <span class="overskriftkommentar pb-5">Kommentarer</span> <i class="fa-solid fa-comments kommentaricon"
                style="color:#00B4D7;"></i>
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
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
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
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua.
                </p>
            </div>
        </div>

        <div class="kommentarboks mb-5 pb-5">
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
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                </p>
            </div>
        </div>


    </div>





    <?php include 'components/navigation2.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>