<?php
session_start();
$status = $_SESSION['Login'];

if ($status == true) {
    ?>

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <title>Document</title>
    </head>
    <body>
    <?php include('dashboard_navbar.php'); ?>

    <div class="container">
        <!-- Placeholder pour l'alerte de succès -->
        <div id="successAlert" class="alert alert-success d-none" role="alert">
            Connexion réussis !
        </div>
    </div>
    <div class="container mt-4">
        <h1>Bienvenue sur le dashboard administrateur</h1>
        <div class="row mt-4">
            <div class="col-md-4">
                <iframe src="dashboard_adduser.php" width="100%" height="500px" frameborder="0"></iframe>
            </div>
            <div class="col-md-4">
                <iframe src="dashboard_addquestion.php" width="100%" height="500px" frameborder="4"></iframe>
            </div>
            <div class="col-md-4">
                <iframe src="dashboard_viewclassement.php" width="100%" height="500px" frameborder="0"></iframe>
            </div>
        </div>
    </div>
    <script>
        // Afficher l'alerte de succès
        document.addEventListener("DOMContentLoaded", function () {
            var successAlert = document.getElementById("successAlert");
            successAlert.classList.remove("d-none");

            // Masquer l'alerte après 3 secondes
            setTimeout(function () {
                successAlert.classList.add("d-none");
            }, 3000);
        });
    </script>
    </body>
    </html>

    <?php
    include('footer.php'); // Incluez le footer après tout le contenu HTML
} else {
    header("Location: dashboard_login.php");
    exit; // Assurez-vous de terminer l'exécution du script après la redirection
}
?>
