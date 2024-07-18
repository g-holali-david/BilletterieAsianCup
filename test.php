<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation de billets pour le match de football au Qatar</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="event.css">
    <style>
    
    </style>
</head>

<body>
    <header>
        <nav class="horizontal-menu">
            <ul>
                <li><a href="#">Accueil</a></li>
                <li><a href="#">Billets</a></li>
                <li><a href="#">Équipes</a></li>
                <li><a href="#">Calendrier</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Login</a></li>
                <li><a href="#">Sign up</a></li>
            </ul>
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

        <h1 style="text-align: center; font-size:50px">Asian Cup Qatar 2023</h1>
        <p style="text-align: center; font-family: Pacifico, cursive; font-size: 20px; font-family: Rowdies, sans-serif;">Réservez vos billets dès maintenant pour assister au match passionnant entre les équipes nationales au Qatar !</p>

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
                        echo "<strong>" . $events[$i] . "</strong> - " . $stades[$i] . "<br> <hr> <p id='display-p'><span id='date-forma'>". $date_fr . "</span>  <span id='time-forma'>&#x1F550;". $times[$i] . " </span></p>" ;
                        echo "<div class='reserve'><img id='rever_icon' src='images/acheter.png' alt='Icone réservation'><span id ='reserv'> Réserver </span></div>";
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


    <script src="script.js"></script>
</body>

</html>