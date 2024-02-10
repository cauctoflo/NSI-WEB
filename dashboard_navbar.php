<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard_adduser.php">Ajouter Utilisateur</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="dashboard_addquestion.php">Ajouter Question</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="dashboard_viewclassement.php">Voir Classement</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php" onclick="logout()">Retour au site</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script>
    function logout() {
        // Envoie une requête GET à logout.php pour détruire la session
        fetch('dashboard_logout.php', { method: 'GET' })
            .then(response => {
                // Redirige vers la page d'accueil une fois que la session est détruite
                window.location.href = 'index.php';
            })
            .catch(error => {
                console.error('Une erreur est survenue : ', error);
            });
    }
</script>
</body>
