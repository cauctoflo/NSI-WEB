<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<div class="container">
    <h1 class="mt-5">Ajouter un utilisateur</h1>
    <form action="" method="post" class="mt-4">
        <input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>">
        <div class="mb-3">
            <label for="username" class="form-label">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter Utilisateur</button>
    </form>
</div>
<?php
require_once('jsonclass.php');

$file_path = 'json/admin_user.json';
$jsonFileManager = new JsonFileManager($file_path);

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
            'password' => $_POST['password'],

        );

        // Ajoute l'utilisateur au fichier JSON
        $players_data = $jsonFileManager->read();
        $players_data[] = $data; // Ajoute le nouvel utilisateur à la fin du tableau existant
        $jsonFileManager->write($players_data);

        ?>
        <div class="alert alert-success" role="alert">
            Utilisateur enregistré !
        </div>
        <?php
    }
}
