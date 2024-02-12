<?php
session_start();

// Vérifier la connexion de l'utilisateur
if (!isset($_SESSION['Login']) || $_SESSION['Login'] !== true) {
    header('Location: login.php');
    exit();
}

// Initialiser les variables de session si nécessaire
if (!isset($_SESSION['current_question'])) {
    $_SESSION['current_question'] = 0;
    $_SESSION['Points'] = 0;
}

// Charger les questions à partir du fichier JSON
require_once('jsonclass.php');
$file_path = 'json/questions.json';
$jsonFileManager = new JsonFileManager($file_path);
$questions = $jsonFileManager->read();

// Vérifier si des questions sont disponibles
$questions_available = !empty($questions) && is_array($questions);
$affichage = false;
// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['answer'])) {
        $affichage = true;
        $question_id = $_SESSION['current_question'];
        $selected_answer = $_POST['answer'];

        // Récupérer la question actuelle
        $question = $questions[$question_id];

        // Récupérer la réponse correcte pour la question actuelle
        $correct_answer = $question['correct_answer'];


        if ($selected_answer == $correct_answer) {
            $_SESSION['Points'] += 30;
            $message = '<div class="alert alert-success" role="alert">Bonne réponse ! Vous avez gagné 30 points.</div>';
        } else {
            $message = '<div class="alert alert-danger" role="alert">Mauvaise réponse. La réponse correcte était : ' . $question['answers'][intval($correct_answer)] . '</div>';
        }
    } elseif (isset($_POST['next_question'])) {
        $_SESSION['current_question']++;
        $affichage = false;
    } elseif (isset($_POST['quiz_finish'])) {
        // Traiter la soumission du quiz terminé
        header('Location: quiz_finish.php'); // Rediriger vers une page de confirmation de fin de quiz
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="css/main_quiz.css"> <!-- Import du CSS personnalisé -->
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="containers text-center">
    <?php
    $question_id = $_SESSION['current_question'];
    if ($questions_available && $question_id < count($questions)) {
        $question = $questions[$question_id];
        ?>
        <div>
            <div class="question" style="padding: 50px;">
                <h1>Question <?php echo $question_id + 1; ?></h1>
                <h4><?php echo $question['question']; ?></h4>
            </div>
            <form method="post">
                <input type="hidden" name="question_id" value="<?php echo $question_id; ?>">
                <div class="input-container">
                    <?php
                    // Affichage des réponses en fonction du type de question
                    switch ($question['type']) {
                        case 'radio':
                            foreach ($question['answers'] as $key => $answer) {
                                echo '<div class="answer-group">';
                                echo '<input type="radio" id="answer_' . $key . '" name="answer" value="' . $key . '" class="input-radio">';
                                echo '<label class="input-label" for="answer_' . $key . '">' . $answer . '</label>';
                                echo '</div>';
                            }
                            break;
                        case 'check':
                            foreach ($question['answers'] as $key => $answer) {
                                echo '<div class="answer-group">';
                                echo '<input type="checkbox" id="answer_' . $key . '" name="answer" value="' . $key . '" class="input-checkbox">';
                                echo '<label class="input-label" for="answer_' . $key . '">' . $answer . '</label>';
                                echo '</div>';
                            }
                            break;
                        case 'dropdown':
                            echo '<select name="answer">';
                            foreach ($question['answers'] as $key => $answer) {
                                echo '<option value="' . $key . '">' . $answer . '</option>';
                            }
                            echo '</select>';
                            break;
                    }
                    ?>
                </div>
                <?php if (isset($message)) : ?>
                    <p><?php echo $message; ?></p>
                <?php endif; ?>
                <button type="submit" class="btn btn-danger">Soumettre la réponse</button>
            </form>
            <?php if ($question_id == count($questions) - 1) : ?>
                <form method="post" action="">
                    <input type="hidden" name="quiz_finish" value="true">
                    <button type="submit" class="btn btn-danger">Finir le quiz</button>
                </form>
            <?php if ($affichage == true) ?>
                <form method="post" action="">
                    <input type="hidden" name="next_question" value="true">
                    <button type="submit" class="btn btn-danger">Question suivante</button>
                </form>
            <?php endif; ?>
        </div>
        <?php
    } else {
        header('Location: quiz_finish.php'); // Rediriger vers une page de confirmation de fin de quiz
        exit();
    }
    ?>
</div>
</body>
<?php include_once 'footer.php' ?>
</html>
