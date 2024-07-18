<?php
session_start();

// Vérifiez si les données de réservation sont soumises via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez les données de réservation soumises via le formulaire
    $categorie = $_POST['categorie'];
    $nombre = $_POST['nomber'];
    $event = $_POST['event'];
    $date = $_POST['date'];
    $stade = $_POST['stade'];
    $times = $_POST['times'];

    // Créez un tableau pour stocker les détails de la réservation
    $reservation = array(
        'categorie' => $categorie,
        'nombre' => $nombre,
        'event' => $event,
        'date' => $date,
        'stade' => $stade,
        'times' => $times
    );

    // Enregistrez les détails de la réservation dans la session de l'utilisateur
    $_SESSION['reservation'] = $reservation;

    // Redirigez l'utilisateur vers la page "carte.php"
    header('Location: carte.php');
    exit();
} else {
    // Si les données ne sont pas soumises via POST, redirigez l'utilisateur vers une page appropriée
    header('Location: index.php');
    exit();
}
?>
