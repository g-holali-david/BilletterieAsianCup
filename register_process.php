<?php
// Assurez-vous que les données du formulaire sont envoyées
if (isset($_POST['register_submit'])) {
    // Récupérez les données du formulaire
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
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

    // Requête SQL pour insérer les données dans la table des utilisateurs
    $sql = "INSERT INTO utilisateur (idUtilisateur, nom, prenom, telephone, email, pwd) VALUES (NULL, '$lastname', '$firstname', '$phone', '$email', '$password')";

    if ($connexion->query($sql) === TRUE) {
        echo "Enregistrement réussi";
    } else {
        echo "Erreur : " . $sql . "<br>" . $connexion->error;
    }

    // Fermeture de la connexion à la base de données
    $connexion->close();
}
?>
