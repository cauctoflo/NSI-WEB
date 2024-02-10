
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/navbar.css">

<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img width="128" src="images/logoporsche.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="#" class="nav-link" aria-current="page">Accueil</a></li>
                    <li class="nav-item"><a href="#Classement" class="nav-link">Classement</a></li>
                    <?php
                    session_start();

                    if (isset($_SESSION['Login']) && $_SESSION['Login'] === true) {
                        // Si l'utilisateur est connecté, afficher le lien de déconnexion
                        echo '<li class="nav-item"><a href="quiz_logout.php" class="nav-link">Déconnexion (' . $_SESSION['User'] . ')</a></li>';
                    } else {
                        // Sinon, afficher le lien de connexion
                        echo '<li class="nav-item"><a onclick="boutonstar()" class="nav-link">Connexion</a></li>';
                    }
                    ?>

                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="dashboard_login.php" class="nav-link">DashBoard</a></li>
                </ul>

            </div>
        </div>
    </nav>
    <script src="/script/function.js"></script>
</header>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

