<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<div class="container">
    <h1 class="mt-5">Ajouter une question</h1>
    <form action="" method="post" class="mt-4">
        <input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>">
        <div class="mb-3">
            <label for="question" class="form-label">Question</label>
            <input type="text" class="form-control" id="question" name="question" required>
        </div>
        <div class="mb-3">
            <label for="answer1" class="form-label">Réponse 1</label>
            <input type="text" class="form-control" id="answer1" name="answer1" required>
        </div>
        <div class="mb-3">
            <label for="answer2" class="form-label">Réponse 2</label>
            <input type="text" class="form-control" id="answer2" name="answer2" required>
        </div>
        <div class="mb-3">
            <label for="answer3" class="form-label">Réponse 3</label>
            <input type="text" class="form-control" id="answer3" name="answer3" required>
        </div>
        <div class="mb-3">
            <label for="answer4" class="form-label">Réponse 4</label>
            <input type="text" class="form-control" id="answer4" name="answer4" required>
        </div>
        <div class="mb-3">
            <label for="correct_answer" class="form-label">Numéro de la bonne réponse</label>
            <input type="number" class="form-control" id="correct_answer" name="correct_answer" min="1" max="4" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter Question</button>
    </form>
</div>

<?php
require_once('jsonclass.php');

$file_path = 'json/questions.json';
$jsonFileManager = new JsonFileManager($file_path);
$id = $jsonFileManager->getQuestionID();
if (!isset($id)) {
    $id = 0;
}

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validation des données du formulaire
    $required_fields = ['question', 'answer1', 'answer2', 'answer3', 'answer4', 'correct_answer'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            ?>
            <div class="alert alert-danger" role="alert">
                Veuillez remplir tous les champs.
            </div>
            <?php
            exit; // Arrête l'exécution du script après l'affichage du message d'erreur
        }
    }

    // Crée les données de la question
    $data = array(
        'id' => $id+1, // Génère un identifiant unique pour la question
        'question' => $_POST['question'],
        'answers' => array(
            $_POST['answer1'],
            $_POST['answer2'],
            $_POST['answer3'],
            $_POST['answer4']
        ),
        'correct_answer' => $_POST['correct_answer']
    );

    // Ajoute la question au fichier JSON
    $questions_data = $jsonFileManager->read();
    $questions_data[] = $data; // Ajoute la nouvelle question à la fin du tableau existant
    $jsonFileManager->write($questions_data);

    ?>
    <div class="alert alert-success" role="alert">
        Question ajoutée avec succès !
    </div>
    <?php
}
?>
