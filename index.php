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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
            <div class="btn rounded-4 btn-secondary px-5 py-2 fw-semibold text-white">Åben kort</div>
        </div>
    </div>
</div>
<!--------------- HEADER --------------->


<!--------------- NAVBAR --------------->
<?php include 'components/navigation.php'; ?>
<!--------------- NAVBAR --------------->





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
