<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation pour l'événement</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="categorie.css">
    <style>
        #logoutDiv {
            display: none;
            position: absolute;
            top: 80px;
            right: 150px;
            background-color: white;
            padding: 10px;
            border: none;
            text-align: center;
            font-weight: bold;
        }

        #catego-box li {
            list-style: none;
            background-color: aqua;
            padding: 10px;
            width: 200px;
        }

        #catego-box ul {
            display: flex;
        }

    </style>
</head>

<body>

    <header>
        <nav class="horizontal-menu">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="#">Billets</a></li>
                <li><a href="#">Équipes</a></li>
                <li><a href="#">Calendrier</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Login</a></li>
                <li><a href="#">Sign up</a></li>
            </ul>

            <span>
                <img id="person" style="width: 50px; right: 10px; z-index: 2;" src="images/utilisateur.png" alt=""
                    onclick="toggleLogoutDiv()">
            </span>

            <div id="logoutDiv">
                <p>Se déconnecter</p>
                <form action="logout.php" method="post">
                    <button type="submit">Déconnexion</button>
                </form>
            </div>


            <?php
            session_start();

            // Vérifiez si l'utilisateur est connecté
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                // Récupérez les informations de l'utilisateur depuis la session
                $user = $_SESSION['user'];

                // Utilisez les informations de l'utilisateur comme vous le souhaitez
                echo "<span id='user'>";

                echo "Bonjour <br> <hr style='color: #6e0f0f;'>" . $user['prenom'];
                echo "</span";
            } else {
                // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
                header('Location: login.php');
                exit();
            }
            ?>
        </nav>


        <div class="menu-icon">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </header>
    <div class="drawer-menu">
        <ul>
            <li><a href="#">Accueil</a></li>
            <li><a href="#">Billets</a></li>
            <li><a href="#">Équipes</a></li>
            <li><a href="#">Calendrier</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </div>


    <main class="main-content">

        <?php
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

        // Requête pour obtenir les catégories et le nombre de places disponibles
        $sql = "SELECT nom AS categorie, prix, nbPlace FROM place AS p, categorie AS c WHERE p.IdCategorie = c.IdCategorie";
        $resultat = $connexion->query($sql);

        // Vérification s'il y a des résultats
        if ($resultat->num_rows > 0) {
            // Stockage des catégories et du nombre de places disponibles
            $categories = array();
            $nbPlaces = array();
            $prix = array();
            while ($row = $resultat->fetch_assoc()) {
                $categories[] = $row["categorie"];
                $prix[] = $row["prix"];
                $nbPlaces[] = $row["nbPlace"];
            }
        } else {
            echo "Aucun résultat trouvé.";
        }

        // Fermeture de la connexion
        $connexion->close();
        echo "<div id='catego-box'>";
        if (!empty($categories) && !empty($nbPlaces)) {
            for ($i = 0; $i < count($categories); $i++) {
                echo "<ul>";
                echo "<li>";
                echo "<strong><span id='catego'> Catégoorie : " . $categories[$i] . " <br>Prix " . $prix[$i] . "€ <br> Places disponibles " . $nbPlaces[$i] . "<br><br>";
                echo "</li>";
                echo "</ul>";
            }
        } else {
            echo "Aucun résultat trouvé.";
        }
        echo "</div>";

        ?>


        <div style="background-color:dimgrey; padding: 20px; border-radius: 20px; opacity: 2;"
            class="catego-details">
            <h1 style="width: 100%; background-color: while;">Réservation</h1>
            <?php
            // Vérification si les paramètres de requête existent
            if (isset($_GET['event']) && isset($_GET['date']) && isset($_GET['stade']) && isset($_GET['times'])) {
                $event = $_GET['event'];
                $date = $_GET['date'];
                $stade = $_GET['stade'];
                $times = $_GET['times'];

                // Formatage de la date en format français
                $date_fr = date('j F Y', strtotime($date));

                // Affichage des détails de l'événement
                echo "<h2>$event</h2>";
                echo "<p>Date: $date_fr</p>";
                echo "<p>Stade: $stade</p>";
                echo "<p>Heure: $times</p>";

                echo "<hr>";

                // Affichage de la liste des catégories et nombre de places disponibles
                // Formulaire de réservation
                echo "<form action='process_reservation.php' method='post'>";
                echo "<label for='categorie'>Catégorie:</label>";
                echo "<select id='categorie' name='categorie' required>";
                foreach ($categories as $index => $categorie) {
                    echo "<option value='$index'>$categorie - " . $prix[$index] . "€</option>";
                }
                echo "</select><br>";
                echo "<br><label for='nombre'>Nombre de places:</label>";
                echo "<input type='number' id='nombre' name='nombre' required><br>";
                echo "<input type='hidden' name='event' value='$event'>";
                echo "<input type='hidden' name='date' value='$date'>";
                echo "<input type='hidden' name='stade' value='$stade'>";
                echo "<input type='hidden' name='times' value='$times'>";
                echo "<br><button type='submit'>Réserver votre billet</button>";
                echo "</form>";
            } else {
                echo "<p>Aucune information d'événement n'a été fournie.</p>";
            }
            ?>
        </div>
    </main>


    <script>
        function toggleLogoutDiv() {
            var logoutDiv = document.getElementById("logoutDiv");
            if (logoutDiv.style.display === "block") {
                logoutDiv.style.display = "none";
            } else {
                logoutDiv.style.display = "block";
            }
        }
    </script>

</body>

</html>
