<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Classement des joueurs</title>
    <link rel="stylesheet" href="css/quiz_finish.css">
</head>
<body >
<div class="container mt-5" data-bs-theme="dark">

    <h1 class="text-center" style=" font-size: 50px; font-weight: bold;  padding: 50px; font-family: 'Nunito', sans-serif !important;">Classement des Joueurs</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Classement</th>
            <th scope="col">Nom</th>
            <th scope="col">Score</th>
            <th scope="col">Date</th>
        </tr>
        </thead>
        <tbody>
        <?php
        session_start();
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        if (!isset($_SESSION['Login']) || $_SESSION['Login'] !== true) {
            header('Location: quiz_login.php');
            exit();
        }

        if (!isset($_SESSION['current_question'])) {
            $_SESSION['current_question'] = 0;
            $_SESSION['Points'] = 0;
        }

        require_once('jsonclass.php');

        $file_path = 'json/players.json';
        $jsonFileManager = new JsonFileManager($file_path);

        // Lecture des données des joueurs
        $players_data = $jsonFileManager->read();

        // Vérifier si les données des joueurs sont un tableau
        if (!is_array($players_data)) {
            $players_data = []; // Initialiser comme un tableau vide si nécessaire
        }

        // Recherche du joueur dans les données existantes
        $player_index = array_search($_SESSION['User'], array_column($players_data, 'name'));

        if ($player_index !== false) {
            // Le joueur existe déjà, mettez à jour son score
            $players_data[$player_index]['score'] = $_SESSION['Points'];
        } else {
            // Le joueur n'existe pas encore, ajoutez une nouvelle entrée
            $players_data[] = array(
                'name' => $_SESSION['User'],
                'score' => $_SESSION['Points'],
                'date' => date('Y-m-d')
            );
        }

        // Trie des joueurs par score (du plus grand au plus petit)
        usort($players_data, function($a, $b) {
            // Ajouter des vérifications pour éviter les erreurs
            if (!isset($a['score']) || !isset($b['score'])) {
                return 0; // Retourner 0 pour éviter de casser le tri
            }
            // Assurez-vous que les valeurs de score sont des nombres
            if (!is_numeric($a['score']) || !is_numeric($b['score'])) {
                return 0; // Retourner 0 pour éviter de casser le tri
            }
            return $b['score'] - $a['score'];
        });

        // Enregistrement des données mises à jour dans le fichier JSON
        $jsonFileManager->write($players_data);

        // Affichage du tableau avec les informations des joueurs
        foreach ($players_data as $rank => $player) {
            if ($player['name'] == $_SESSION['User']) {
                $ranking = $rank+1;
            }
            echo "<tr>";
            echo "<td>" . ($rank + 1) . "</td>";
            echo "<td>" . $player['name'] . "</td>";
            echo "<td>" . $player['score'] . "</td>";
            echo "<td>" . $player['date'] . "</td>";
            echo "</tr>";
        }

        ?>


        </tbody>
    </table>
    <?php
    echo '<p class="classements text-center">Vous êtes actuellement classé <span class="classementtop">#' . $ranking . '</span></p>'
    ?>
    <p>Actualiser il y a <span id="tempsEcoule"></span> <a href="dashboard_viewclassement.php">Recharger</a></p>
</div>
<script src="/script/function.js"></script>
</body>
</html>
<?php



// Détruire toutes les données de la session
$_SESSION = array();

// Détruire la session
session_destroy();

exit;


?>