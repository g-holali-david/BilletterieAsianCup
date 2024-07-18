<?php
session_start();

// Vérifiez si l'utilisateur est déjà connecté
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // Redirection vers la page index.php si l'utilisateur est déjà connecté
    header('Location: index.php');
    exit();
}

// Assurez-vous que les données du formulaire sont envoyées
if (isset($_POST['login_submit'])) {
    // Récupérez les données du formulaire
    $username_or_email = $_POST['username_or_email'];
    $password = $_POST['password'];

    // Informations de connexion à la base de données
    $serveur = "localhost";
    $utilisateur = "foot";
    $mot_de_passe = "Pwd2024*";
    $base_de_donnees = "foot";

    // Connexion à la base de données
    $connexion = new mysqli($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

    // Vérification de la connexion
    if ($connexion->connect_error) {
        die("Échec de la connexion : " . $connexion->connect_error);
    }

    // Requête SQL préparée pour vérifier les informations de connexion dans la base de données
    $sql = "SELECT * FROM utilisateur WHERE (nom=? OR email=?) AND pwd=?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("sss", $username_or_email, $username_or_email, $password);
    $stmt->execute();
    $resultat = $stmt->get_result();

    if ($resultat->num_rows > 0) {
        // Utilisateur trouvé, connectez-vous
        $_SESSION['logged_in'] = true;
        // Stockez les informations de l'utilisateur dans la session
        $_SESSION['user'] = $resultat->fetch_assoc();
        // Redirection vers la page index.php
        header('Location: index.php');
        exit();
    } else {
        // Aucun utilisateur trouvé avec les informations de connexion fournies
        $erreur_message = "Identifiant ou mot de passe incorrect";
    }

    // Fermeture de la connexion à la base de données
    $stmt->close();
    $connexion->close();
}
?>

