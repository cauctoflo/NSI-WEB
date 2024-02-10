<?php
require_once('jsonclass.php');

$file_path = 'json/admin_user.json';
$jsonFileManager = new JsonFileManager($file_path);

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupère tous les utilisateurs
    $players_data = $jsonFileManager->read();

    // Vérifie si l'utilisateur existe et si le mot de passe correspond
    foreach ($players_data as $player) {
        if ($player['name'] === $_POST['username'] && $player['password'] === $_POST['password']) {
            session_start();
            $_SESSION['Login'] = true;
            $_SESSION['Name'] = $player['name'];
            header("Location: dashboard_main.php");
            exit;
        }

    }

    // Si l'utilisateur n'est pas trouvé ou le mot de passe est incorrect
    ?>
    <div class="alert alert-danger" role="alert">
        Identifiants incorrects !
    </div>
    <?php
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-ZFMXwxFZQrxKG5Uk2C+tRjOOiNAx0gW0AokJw+2o8VcSZ+Wr1VQQNOx2wDEEqdB+aOvZu/QgrsYWq9lFOBZqAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/b6ddb4b5dd.js" crossorigin="anonymous"></script>
    <title>Page de Connexion</title>
    <link rel="stylesheet" href="css/login_quiz.css">
</head>
<body>
<div class="container">
    <div class="form-container">
        <div class="text-center">
            <img src="/images/logoporsche.png" width="100px" alt="">
        </div>
        <form method="post">
            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Connexion</button>
            </div>
        </form>

    </div>
</div>
</body>
</html>
