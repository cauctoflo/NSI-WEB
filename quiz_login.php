<?php
require_once('jsonclass.php');

$file_path = 'json/players.json';
$jsonFileManager = new JsonFileManager($file_path);

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['password'] == '911gt3rs') {
        // Récupère tous les noms d'utilisateurs
        $player_names = $jsonFileManager->getPlayerNames();

        // Vérifie si l'utilisateur est déjà enregistré
        $is_user_registered = in_array($_POST['username'], $player_names);

        if ($is_user_registered) {
            ?>
            <div class="alert alert-danger" role="alert">
                Utilisateur déjà enregistré !
            </div>
            <?php
        } else {
            // Crée les données de l'utilisateur
            $data = array(
                'name' => $_POST['username'],
                'score' => 0,
                'date' => date('Y-m-d')
            );

            // Ajoute l'utilisateur au fichier JSON
            $players_data = $jsonFileManager->read();
            $players_data[] = $data; // Ajoute le nouvel utilisateur à la fin du tableau existant
            $jsonFileManager->write($players_data);
            session_start();
            $_SESSION['Login'] = true;
            $_SESSION['User'] = $_POST['username'];
            $_SESSION['Points'] = 0;

            // Redirige l'utilisateur vers la page quiz_main.php
            header('Location: quiz_main.php');
            exit(); // Assurez-vous d'arrêter l'exécution du script après la redirection
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">Mauvais mots de passe</div>';
    }

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
            <img src="images/logoporsche.png" width="100px" alt="">
        </div>
        <form method="post">
            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Clef secrète</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Connexion</button>
            </div>
        </form>
        <div class="text-center " ><a style="text-decoration: none; color: white;" href="index.php">Retours au site</a></div>

    </div>
</div>
</body>
</html>
