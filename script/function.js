/**
 * Demande à l'utilisateur s'il souhaite être redirigé vers le site de Porsche France.
 * Si l'utilisateur confirme, redirige vers le site, sinon affiche un message dans la console.
 */
function redirectReferencePorsche() {
    // Demander à l'utilisateur s'il souhaite être redirigé
    var confirmation = window.confirm("Vous allez être redirigé vers le site de Porsche France. Voulez-vous continuer ?");

    // Vérifier la réponse de l'utilisateur
    if (confirmation) {
        // Code à exécuter si l'utilisateur clique sur "OK" ou "Oui"
        window.location.href = 'https://www.porsche.com/france/';
    } else {
        // Code à exécuter si l'utilisateur clique sur "Annuler" ou "Non" ou ferme la boîte de dialogue
        console.log('Redirection annulé par l\'utilisateur');
    }
}
// Stocke le moment du chargement initial de la page
const tempsDebut = new Date();

// Fonction pour mettre à jour le temps écoulé
function mettreAJourTempsEcoule() {
    // Obtient le temps actuel
    const tempsActuel = new Date();

    // Calcule la différence en millisecondes
    const difference = tempsActuel - tempsDebut;

    // Convertit la différence en secondes
    const secondesEcoulees = Math.floor(difference / 1000);

    // Met à jour le contenu de l'élément HTML
    document.getElementById('tempsEcoule').textContent = "" + secondesEcoulees + " secondes.";
}

// Appelle la fonction de mise à jour toutes les secondes
setInterval(mettreAJourTempsEcoule, 1000);


function boutonstar() {
    window.location.href = "quiz_login.php"

}