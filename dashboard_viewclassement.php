<?php
require_once('jsonclass.php'); // Assurez-vous que le fichier JsonFileManager.php est inclus ici avec le bon chemin

$file_path = 'json/players.json';
$jsonFileManager = new JsonFileManager($file_path);

// Lecture des données des joueurs
$players_data = $jsonFileManager->read();

// Trie des joueurs par score (du plus grand au plus petit)
usort($players_data, function($a, $b) {
    return $b['score'] - $a['score'];
});

// Affichage du tableau avec les informations des joueurs
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Classement des joueurs</title>
</head>
<body>
<div class="container mt-5">
    <h2>Classement des Joueurs</h2>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Score</th>
            <th scope="col">Date</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($players_data as $player): ?>
            <tr>
                <td><?php echo $player['name']; ?></td>
                <td><?php echo $player['score']; ?></td>
                <td><?php echo $player['date']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <p>Actualiser il y a <span id="tempsEcoule"></span> <a href="dashboard_viewclassement.php">Recharger</a></p>
</div>
<script src="/script/function.js"></script>
</body>
</html>
