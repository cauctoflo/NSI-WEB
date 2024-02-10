<?php
session_start();

if (!isset($_SESSION['Login']) || $_SESSION['Login'] !== true) {
    header('Location: login.php');
    exit();
}

if (!isset($_SESSION['current_question'])) {
    $_SESSION['current_question'] = 0;
    $_SESSION['Points'] = 0;
}

require_once('jsonclass.php');

$file_path = 'json/questions.json';
$jsonFileManager = new JsonFileManager($file_path);
$questions = $jsonFileManager->read();
$affichage = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $affichage = true;
    if (isset($_POST['answer'])) {
        $question_id = $_SESSION['current_question'];
        $selected_answer = $_POST['answer'];
        $correct_answer = $questions[$question_id]['correct_answer'];

        if ($selected_answer == $correct_answer) {
            $_SESSION['Points'] += 30;
            $message = '<div class="alert alert-success" role="alert">Bonne réponse ! Vous avez gagné 30 points.</div>';


        } else {
            $message = "Mauvaise réponse. La réponse correcte était : " . $questions[$question_id]['answers'][$correct_answer];
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
<?php
include 'navbar.php';
?>
<div class="containers text-center">
    <?php
    $question_id = $_SESSION['current_question'];
    if ($question_id < count($questions)) {
        $question = $questions[$question_id];
        ?>
        <div>
            <div class="question" style="padding: 50px;">
                <h1>Question <?php echo $question_id + 1; ?></h1>
                <h4><?php echo $question['question']; ?></h4>
            </div>
            <form method="post">
                <input type="hidden" name="question_id" value="<?php echo $question_id; ?>">
                <div class="input-container"> <!-- Container pour les inputs radio -->
                    <?php foreach ($question['answers'] as $key => $answer) : ?>
                        <div class="answer-group">
                            <input type="radio" id="answer_<?php echo $key; ?>" name="answer" value="<?php echo $key; ?>" class="input-radio">
                            <label class="input-label" for="answer_<?php echo $key; ?>"><?php echo $answer; ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
                <input type="text" hidden="hidden" id="affichage" value="true">
                <button type="submit" class="btn btn-danger">Soumettre la réponse</button>
            </form>
            <?php if (isset($message)) : ?>
                <p><?php echo $message; ?></p>
            <?php endif; ?>
        </div>
        <form method="post" action="">

            <?php if ($question_id == count($questions) - 1) :
                if ($affichage == true) :
                    $affichage = false;?>


                    <input type="hidden" name="quiz_finish" value="true">
                    <button type="submit" class="btn btn-danger">Finir le quiz</button>
                <?php endif; ?>
            <?php endif; ?>
            <?php if ($affichage == true) : ?>
                <input type="hidden" name="next_question" value="true">
                <button type="submit" class="btn btn-danger">Question suivante</button>

            <?php endif; ?>
        </form>

        <?php
    } else {

        header('Location: quiz_finish.php'); // Rediriger vers une page de confirmation de fin de quiz
        exit();
    }


    ?>
</div>

</body>
<?php
include_once 'footer.php'
?>
</html>
