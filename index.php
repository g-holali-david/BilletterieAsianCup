<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation de billets pour le match de football au Qatar</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="event.css">
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
        <img id="person" style="width: 50px; right: 100px; z-index: 2;" src="images/utilisateur.png" alt="" onclick="toggleLogoutDiv()">
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

    <main>
        <?php
        // Inclusion du fichier event.php pour récupérer les données
        include 'event.php';
        ?>

        <div>
            <img id="ballon" src="images/ballon.png" alt="">
            <h1 style="text-align: center; font-size:50px">Asian Cup Qatar 2023</h1>
            <p style="text-align: center; font-family: Pacifico, cursive; font-size: 20px; font-family: Rowdies, sans-serif;">Réservez vos billets dès maintenant pour assister au match passionnant entre les équipes nationales au Qatar !</p>
        </div>


        <div class="image-container">
            <div id="event-box">
                <?php
                // Affichage personnalisé des données
                if (!empty($events) && !empty($dates) && !empty($stades)) {
                    for ($i = 0; $i < count($events); $i++) {
                        // Formatage de la date en format français
                        $date_fr = date('j F Y', strtotime($dates[$i]));

                        echo "<div class='event-list'>";
                        echo "<span class='date-icon'></span>"; // Icône pour la date
                        echo "<strong> <span id='events'>" . $events[$i] . " - " . $stades[$i] . " </span> </strong> <br> <hr> <p id='display-p'><span id='date-forma'>" . $date_fr . "</span>  <span id='time-forma'>&#x1F550;" . $times[$i] . " </span></p>";
                        echo "<div class='reserve'><a href='reservation.php?event=" . urlencode($events[$i]) . "&date=" . urlencode($dates[$i]) . "&stade=" . urlencode($stades[$i]) . "&times=" . urlencode($times[$i]) . "'><img id='rever_icon' src='images/acheter.png' alt='Icone réservation'><span id ='reserv'> Réserver </span></a></div>";
                        echo "</div>";
                    }
                } else {
                    echo "Aucun résultat trouvé.";
                }
                ?>
            </div>
            <img id="foot1" src="images/foot1.jpeg" alt="">
        </div>
    </main>




    <footer>
        <div style="border-radius:30px; margin: 0;
        padding: 20px; opacity:0.5" class="footer-content">
            <a href="https://facebook.com"><img style="float:left; width: 30px; border-radius: 50px;" src="images/f.png" alt="Icone">facebook</a>
            <a href="https://twitter.com"><img style="float:left; width: 50px; border-radius: 50px;" src="images/x.webp" alt="Icone">twitter</a>
            <p>© 2024 Asian Cup Qatar. Tous droits réservés.</p>
        </div>
    </footer>



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

    <script src="script.js"></script>
    <script>

    </script>
</body>

</html>