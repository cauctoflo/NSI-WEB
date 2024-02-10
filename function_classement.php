<?php
function afficherClassement($nombreJoueurs) {
    // Chemin vers le fichier JSON contenant les données des joueurs
    $file_path = 'json/players.json';

    // Vérifier si le fichier existe
    if (!file_exists($file_path)) {
        return "Le fichier JSON des joueurs n'existe pas.";
    }

    // Lire le contenu du fichier JSON
    $players_data = file_get_contents($file_path);

    // Décoder le contenu JSON en un tableau associatif
    $players_data = json_decode($players_data, true);

    // Vérifier si la lecture et le décodage ont réussi
    if ($players_data === null) {
        return "Erreur lors de la lecture du fichier JSON des joueurs.";
    }

    // Commencer la sortie du tableau HTML
    $table = '<table class="table">
                <thead>
                    <tr>
                        <th>Classements</th>
                        
                        <th>Nom du joueur</th>
                        <th>Points</th>
                        <th>Bonnes réponses</th>
                    </tr>
                </thead>
                <tbody>';

    // Limiter le nombre de joueurs affichés au nombre spécifié
    $nombreJoueurs = min($nombreJoueurs, count($players_data));

    // Remplir le tableau avec les informations des joueurs
    for ($i = 0; $i < $nombreJoueurs; $i++) {
        $player = $players_data[$i];
        $scoretotal = round($player['score'] / 30);

        // Ajouter une rangée pour chaque joueur
        $table .= '<tr>
                    <td>#'.($i + 1).'</td>
                    <td>'.$player['name'].'</td>
                    <td>'.$player['score'].'</td>
                    <td>'. $scoretotal .'</td>
                </tr>';
    }

    // Clôturer la table HTML
    $table .= '</tbody></table>';

    // Retourner le code HTML du tableau généré
    return $table;
}

// Exemple d'utilisation :

?>
