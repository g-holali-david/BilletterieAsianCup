<!DOCTYPE html>
<html>
<head>
    <title>Page de Paiement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url("images/match1.jpeg");
            background-repeat: no-repeat;
        }
        .payment-form {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: silver;
            opacity: 0.7;
        }
        .payment-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .payment-form label {
            display: block;
            margin-bottom: 10px;
        }
        .payment-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .payment-form button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 10px; /* Ajout */
        }
        .payment-form button:hover {
            background-color: #45a049;
        }
        /* Style pour le bouton Annuler */
        .payment-form button.cancel {
            background-color: #f44336;
        }
        .payment-form button.cancel:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="payment-form">
        <h2>Paiement par Carte Bancaire</h2>
        <form>
            <label for="cname">Nom sur la Carte</label>
            <input type="text" id="cname" name="cardname" placeholder="John More Doe">

            <label for="ccnum">Numéro de la Carte Bancaire</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">

            <label for="expmonth">Mois d'Expiration</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="Septembre">

            <label for="expyear">Année d'Expiration</label>
            <input type="text" id="expyear" name="expyear" placeholder="2023">

            <label for="cvv">CVV</label>
            <input type="text" id="cvv" name="cvv" placeholder="352">

            <button type="submit">Soumettre le Paiement</button>

            <!-- Bouton Annuler -->
            <button type="button" class="cancel" onclick="annulerAchat()">Annuler</button>
        </form>
    </div>

    <script>
        // Fonction pour annuler l'achat et revenir à la page d'accueil
        function annulerAchat() {
            // Redirection vers la page d'accueil
            window.location.href = "index.php";
        }
    </script>
</body>
</html>
