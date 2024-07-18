<?php
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

$sql = "SELECT c.nom AS categorie, p.nbPlace FROM place AS p INNER JOIN categorie AS c ON p.IdCategorie = c.IdCategorie";

$resultat = $connexion->query($sql);

// Vérification s'il y a des résultats
if ($resultat->num_rows > 0) {
    // Initialisation des variables
    $categories = array();
    $nbPlaces = array();

    // Stockage des données dans les variables
    while($row = $resultat->fetch_assoc()) {
        $categories[] = $row["categorie"];
        $nbPlaces[] = $row["nbPlace"];
    }
} else {
    echo "Aucun résultat trouvé.";
}

// Fermeture de la connexion
$connexion->close();
?>


