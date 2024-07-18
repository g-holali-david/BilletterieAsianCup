<?php
session_start();

// Vérifiez si les données de réservation sont soumises via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez les données de réservation soumises via le formulaire
    $categorie = $_POST['categorie'];
    $nombre = $_POST['nombre']; // Correction de la variable nomber en nombre
    $event = $_POST['event'];
    $date = $_POST['date'];
    $stade = $_POST['stade'];
    $times = $_POST['times'];

    // Ajoutez les informations supplémentaires nécessaires
    $idUtilisateur = $_SESSION['user']['id']; // Supposons que l'ID de l'utilisateur est stocké dans la session
    $modePaiement = "Carte bancaire"; // Vous pouvez modifier cela en fonction du mode de paiement réel

    // Connexion à la base de données
    $serveur = "localhost";
    $utilisateur = "foot";
    $mot_de_passe = "Pwd2024*";
    $base_de_donnees = "foot";

    $connexion = new mysqli($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

    // Vérification de la connexion
    if ($connexion->connect_error) {
        die("Échec de la connexion : " . $connexion->connect_error);
    }

    // Requête pour obtenir le prix de la catégorie
    $sql_prix = "SELECT prix FROM categorie WHERE IdCategorie = ?";
    $stmt_prix = $connexion->prepare($sql_prix);
    $stmt_prix->bind_param("i", $categorie);
    $stmt_prix->execute();
    $result_prix = $stmt_prix->get_result();

    // Vérification s'il y a des résultats
    if ($result_prix->num_rows > 0) {
        $row_prix = $result_prix->fetch_assoc();
        $prix = $row_prix["prix"];
    } else {
        echo "Prix non trouvé pour cette catégorie.";
        exit(); // Arrêter le script si le prix n'est pas trouvé
    }

    // Calcul du total payé
    $totalPaye = $nombre * $prix;

    // Préparez la requête SQL INSERT
    $sql = "INSERT INTO reservation (idUtilisateur, IdCategorie, idEvenement, date_reservation, mode_paiement, total_paye) VALUES (?, ?, ?, ?, ?, ?)";

    // Préparez et exécutez la requête préparée
    if ($stmt = $connexion->prepare($sql)) {
        // Liaison des paramètres
        $stmt->bind_param("iiisii", $idUtilisateur, $categorie, $event, $date, $modePaiement, $totalPaye);

        // Exécutez la déclaration
        if ($stmt->execute()) {
            // Redirigez l'utilisateur vers la page "carte.php" après avoir réussi l'insertion
            header('Location: carte.php');
            exit();
        } else {
            echo "Erreur lors de l'exécution de la requête : " . $stmt->error;
        }

        // Fermeture de la déclaration
        $stmt->close();
    } else {
        echo "Erreur lors de la préparation de la requête : " . $connexion->error;
    }

    // Fermeture de la connexion
    $connexion->close();
} else {
    // Si les données ne sont pas soumises via POST, redirigez l'utilisateur vers une page appropriée
    header('Location: index.php');
    exit();
}
?>






























