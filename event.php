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

// Requête SQL pour récupérer les données
$sql = "SELECT evenement.nom AS event_nom, evenement.date AS event_date, lieu.nom AS stade_nom FROM evenement INNER JOIN lieu ON evenement.IdStade = lieu.IdStade";

$sql2 = "SELECT nom AS categorie, nbPlace FROM place AS p, categorie AS c WHERE p.IdCategorie = c.IdCategorie";

$resultat = $connexion->query($sql);

// Vérification s'il y a des résultats
if ($resultat->num_rows > 0) {
    // Initialisation des variables
    $events = array();
    $dates = array();
    $stades = array();
    $times = array(); // Nouvelle variable pour stocker les heures
    
    // Stockage des données dans les variables
    while($row = $resultat->fetch_assoc()) {
        $events[] = $row["event_nom"];
        
        // Séparer la date et l'heure
        $datetime = strtotime($row["event_date"]);
        $dates[] = date("Y-m-d", $datetime); // Date
        $times[] = date("H:i", $datetime); // Heure
        
        $stades[] = $row["stade_nom"];
    }
} else {
    echo "Aucun résultat trouvé.";
}

// Fermeture de la connexion
$connexion->close();
?>
