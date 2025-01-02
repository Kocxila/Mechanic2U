<?php
// Include config file
require_once "./includes/config.php";

// Define variables and initialize with empty values
$nom = $prenom = $email = $numero = $marque = $annee_prod = $localisation = $service = $message = "";
$nomErr = $prenomErr = $emailErr = $numeroErr = $marqueErr = $annee_prodErr = $service = $messageErr = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate lastname(nom) & firstname(prénom)
    if (empty(trim($_POST["nom"]))) {
        $nomErr = "Nom obligatoire.";
    } elseif (!preg_match('/^[a-zA-z]*$/', trim($_POST["nom"]))) {
        $nomErr = "Votre nom doit seulement contenir des lettres.";
    }

    if (empty(trim($_POST["prenom"]))) {
        $prenomErr = "Prénom obligatoire.";
    } elseif (!preg_match('/^[a-zA-z]*$/', trim($_POST["prenom"]))) {
        $prenomErr = "Votre prénom doit seulement contenir des lettres.";
    }

    // Validate tel 
    if (empty(trim($_POST["numero"]))) {
        $numeroErr = "Entrez un numéro de téléphone.";
    } elseif (!preg_match('/^[0-9]{10}+$/', trim($_POST["numero"]))) {
        $numeroErr = "Veuillez saisir un numéro de téléphone valide.";
    }

    // Validate localisation
    if (empty($_POST["marque"])) {
        $marqueErr = "Veuillez remplir ce champ obligatoire.";
    } else {
        $marque = trim($_POST["marque"]);
    }
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);
    $localisation = $_POST["localisation"];
    $annee_prod = trim($_POST["annee_prod"]);



    // Check input errors before inserting in database
    if (empty($nomErr) && empty($prenomErr) && empty($numeroErr) && empty($marqueErr)) {

        // Prepare an insert statement
        $sql = "INSERT INTO reparation_durgence (nom, prenom, email, numero, marque, annee_prod, localisation, service, commentaire) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($database, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssss", $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['numero'], $_POST['marque'], $_POST['annee_prod'], $localisation, $_POST['service'], $_POST['message']);
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: ./sos.php");
            } else {
                echo "Oops! Une erreur est survenue. Veuillez réessayer plus tard.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($database);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Obtenir une réparation urgente - Mechanic2U</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
        integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
        crossorigin="" />
    <link rel="stylesheet" type="text/css"
        href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.css" />
    <link rel="stylesheet" type="text/css"
        href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.Default.css" />

    <link rel="stylesheet" href="../style/media.css">
    <link rel="stylesheet" href="../style/sos.css">
</head>

<body id="sos">
    <?php
    include_once './includes/header.php';
    ?>

    <div class="heading" style="background:url(../images/background.jpg) no-repeat">
        <h1>Réparation d'urgence</h1>
    </div>

    <!--devis section-->
    <section class="devis ">
        <div class="content">
            <h1 class="devis-title">Obtenez de l'aide!</h1>
            <form method="POST">
                <div class="row">
                    <div class="form-group">
                        <span>Nom</span>
                        <input type="text" name="nom" placeholder="Nom" class="box">
                        <span class="error">
                            <?php echo $nomErr; ?>
                        </span>
                    </div>
                    <div class="form-group">
                        <span>Prénom</span>
                        <input type="text" name="prenom" placeholder="Prénom" class="box">
                        <span class="error">
                            <?php echo $prenomErr; ?>
                        </span>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <span><i class="fa-solid fa-envelope"></i> Adresse e-mail</span>
                        <input type="text" name="email" placeholder="Ex: nom@domaine.com" class="box">
                        <span class="error">
                            <?php echo $emailErr; ?>
                        </span>
                    </div>

                    <div class="form-group">
                        <span><i class="fa-solid fa-phone"></i> Numéro de téléphone</span>
                        <input type="text" name="numero" maxlength="10" placeholder="(+213) 0y xx xx xx xx" class="box">
                        <span class="error">
                            <?php echo $numeroErr; ?>
                        </span>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <span>Marque:</span>
                        <input type="text" name="marque" placeholder="Entrez la marque de votre véhicule" class="box">
                    </div>
                    <div class="form-group">
                        <span>Année de production:</span>
                        <input type="number" min="1900" max="2023" step="1"
                            placeholder="Entrez l'année de production de votre véhicule" name="annee_prod" class="box">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <span><i class="fa-brands fa-servicestack"></i> Catégorie de services:</span>
                        <select name="service" class="box">
                            <option value="prestation" selected disabled>Sélectionnez une catégorie</option>
                            <option value="Prestations Fréquentes">Prestations Fréquentes</option>
                            <option value="Direction & Transmission">Direction & Transmission</option>
                            <option value="Moteur">Moteur</option>
                            <option value="Éclairage et visibilité">Éclairage et visibilité</option>
                            <option value="Suspension">Suspension</option>
                            <option value="Échappement">Échappement</option>
                            <option value="Embrayage">Embrayage</option>
                            <option value="Pneus/Roues">Pneus/Roues</option>
                            <option value="Freinage">Freinage</option>
                            <option value="Batterie, alternateur et démarreur">Batterie, alternateur et démarreur
                            </option>
                            <option value="Climatisation & Chauffage">Climatisation & Chauffage</option>
                            <option value="Remplacement des vitres">Remplacement des vitres</option>
                            <option value="Ditribution">Ditribution</option>
                            <option value="Diagnostics">Diagnostics</option>
                            <option value="Refroidissement">Refroidissement</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <span><i class="fa-solid fa-location-dot"></i> Localisation:</span>
                        <textarea name="localisation" id="coordinates" cols="" rows="" class="box"></textarea>
                    </div>
                </div>
                <div id="map"></div>
                <div class="row">
                    <div class="form-group">
                        <span>Veuillez nous dire ce qui vous pose problème aujourd'hui</span>
                        <textarea name="message" id="message" cols="" rows="" class="box"></textarea>
                    </div>
                </div>

                <div align="center" class="form-footer">
                    <input type="submit" value="Envoyer" class="devis-btn" name="send"
                        onclick="return confirm('Confirmer votre demande')">
                    <input type="reset" class="devis-btn" value="Réinitialiser">
                    <p>Voulez vous en savoir plus? <a href="faq.php">Cliquez ici</a>.
                    </p>
                </div>
            </form>
        </div>
    </section>

    <?php
    include_once './includes/footer.php';
    ?>

</body>

</html>

<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
    integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
    crossorigin=""></script>
<script type='text/javascript'
    src='https://unpkg.com/leaflet.markercluster@1.3.0/dist/leaflet.markercluster.js'></script>

<script type="text/javascript" src="../script/sos.js"></script>

</body>

</html>