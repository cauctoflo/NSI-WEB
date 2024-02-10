<!doctype html>
<html lang="en">
<head>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link href="https://fonts.cdnfonts.com/css/nunito" rel="stylesheet">

        <link rel="stylesheet" href="/css/index.css">
        <title>PorschaQuiz - Accueil</title>

</head>
<body data-bs-theme="dark">
    <?php include 'navbar.php' ?>
    <div class="container vertical-center d-flex justify-content-center align-self-center" style="padding: 250px">
    <div class="row text-center" >
        <div>
            <h1 class="ml10">
                <span class="text-wrapper">
                    <div class="typing-effect">
                        <span onclick="redirectReferencePorsche();" style="cursor: pointer;" id="text" class="letter"></span>
                        <div class="cursor"></div>
                        <button class="" style="width: calc(100% - 25px); margin-top: -400px;">
                            <a href="https://www.porsche.com/france/"></a>
                        </button>
                        <div class="text-center mt-3">
                        <a onclick="boutonstar()" ><button  class="btn btn-danger quiz-start">Commencer</button></a>
                    </div>

                </span>
            </h1>
        </div>
    </div>
    </div>

    <div style="height: 10%"></div>
    <div class="container-fluid">
        <div class="row" style="padding-top: 50px; padding-bottom: 150px; max-height: 1000px">
            <div class="col-md-6" >
                <!-- Contenu de la première moitié de la page (Tableau des classements) -->
                <div class="text-center " >
                    <h2 id="Classement">Classement</h2>
                    <div class="d-flex align-items-center justify-content-center vertical-center" style="padding-top: 1.5em; max-height: 1000px">
                        <?php
                        include 'function_classement.php';
                        $nombreJoueurs = 8; // Définir le nombre de joueurs à afficher
                        echo afficherClassement($nombreJoueurs); // Affiche le tableau des joueurs
                        ?>
                    </div>

                    <p>Actualiser il y a <span id="tempsEcoule"></span> <a href="index.php">Recharger</a></p>
                </div>

            </div>
            <div class="col-md-6">
                <!-- Contenu de la deuxième moitié de la page (Image de la Porsche) -->
                <div class="text-center">
                    <img style="border-radius: 12%; " class="w-100" src="/images/test.webp" alt="Porsche Image">
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <!-- Contenu de la deuxième moitié de la page (Image de la Porsche) -->
                <div class="text-center">
                    <img style="border-radius: 20px" class="w-100" src="/images/porsche911.png" alt="Porsche Image">
                </div>
            </div>
            <div class="col-md-6 vertical-center">
                <!-- Contenu de la première moitié de la page (Tableau des classements) -->
                <div class="container text-center">
                    <h2 id="Classement">Comment Participer ?</h2>
                    <div class="quiz-info d-flex align-items-center justify-content-center">
                        <p class="text-muted">
                            Bienvenue sur notre quiz passionnant ! Pour participer, suivez ces étapes simples :
                        </p>
                    </div>
                    <div class="quiz-info " >

                        <li class="text-muted" style="margin-bottom: 10px">Appuyez sur le bouton "Commencer" ci-dessous.</li>
                        <li class="text-muted" style="margin-bottom: 10px">Vous serez dirigé vers le premier ensemble de questions.</li>
                        <li class="text-muted" style="margin-bottom: 10px">Répondez à chaque question en choisissant la réponse qui vous semble correcte.</li>
                        <li class="text-muted" style="margin-bottom: 10px">Cliquez sur "Suivant" pour passer à la question suivante.</li>
                        <li class="text-muted" style="margin-bottom: 10px">À la fin du quiz, votre score sera affiché et enregistré dans le classement.</li>

                    </div>
                    <div class="text-center col-md-12" style="margin-top: 50px">
                        <a onclick="boutonstar()" ><button  class="btn btn-danger quiz-start">Commencer</button></a>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <?php
    include('footer.php');
    session_start();
    // Détruire toutes les données de la session
    $_SESSION = array();

    // Détruire la session
    session_destroy();
    header('index.php');


    ?>

    <script src="/script/index.js"></script>
    <script src="/script/function.js"></script>
</body>
</html>