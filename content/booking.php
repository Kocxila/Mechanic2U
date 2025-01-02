<?php
// Include config file
require_once "./includes/config.php";

// Define variables and initialize with empty values
$lastname = $firstname = $email = $tel = $adress = $make = $model = $year = $service = $date = "";
$lastname_err = $firstname_err = $email_err = $tel_err = $adress_err = $make_err = $model_err = $year_err = $service_err = $date_err = "";

// Initialize the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) {
        $id = $_SESSION['user_id'];
        $query = mysqli_query($database, "SELECT * FROM utilisateurs where id_utilisateur='$id'");
        $row = mysqli_fetch_array($query);
        $lastname = $row['nom_utilisateur'];
        $firstname = $row['prenom_utilisateur'];
        $email = $row['email_utilisateur'];
        $tel = $row['tel_utilisateur'];
    }
}


// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {



    if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
        echo "<script>alert('Vous devez être connecté pour envoyer les données.');</script>";
        header("location: ./authentification/login.php");
        exit; // Arrête l'exécution du script
    }


    // Validate lastname(nom) & firstname(prénom)
    if (empty(trim($_POST["last-name"]))) {
        $lastname_err = "Nom obligatoire.";
    } elseif (!preg_match('/^[a-zA-z]*$/', trim($_POST["last-name"]))) {
        $lastname_err = "Votre nom doit seulement contenir des lettres.";
    }

    if (empty(trim($_POST["first-name"]))) {
        $firstname_err = "Prénom obligatoire.";
    } elseif (!preg_match('/^[a-zA-z]*$/', trim($_POST["first-name"]))) {
        $firstname_err = "Votre prénom doit seulement contenir des lettres.";
    }

    // Validate tel 
    if (empty(trim($_POST["tel"]))) {
        $tel_err = "Entrez un numéro de téléphone.";
    } elseif (!preg_match('/^[0-9]{10}+$/', trim($_POST["tel"]))) {
        $tel_err = "Veuillez saisir un numéro de téléphone valide.";
    }
    if (empty(trim($_POST["email"]))) {
        $email_err = "Entrez une adresse e-mail.";
    } elseif (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", trim($_POST["email"]))) {
        $email_err = "Le format de l'adresse e-mail saisie n'est pas valide";
    }

    if (empty(trim($_POST["adress"]))) {
        $adress_err = "Adresse obligatoire.";
    }
    if (empty(trim($_POST["make"]))) {
        $make_err = "Marque obligatoire.";
    } elseif (!preg_match('/^[a-zA-z]*$/', trim($_POST["make"]))) {
        $make_err = "Ce champ doit seulement contenir des lettres.";
    }
    if (empty(trim($_POST["model"]))) {
        $model_err = "Modèle obligatoire.";
    }
    if (empty(trim($_POST["year"]))) {
        $year_err = "Année de production obligatoire.";
    }

    if (empty(trim($_POST["date"]))) {
        $date_err = "Veuillez choisir une date.";
    }


    // Validate Service
    if (empty($_POST["services"]) || $_POST["services"] == "services") {
        $service_err = "Veuillez choisir une prestation.";
    } else {
        $service = trim($_POST["services"]);
    }

    // Check input errors before inserting in database
    if (empty($lastname_err) && empty($firstname_err) && empty($email_err) && empty($tel_err) && empty($adress_err) && empty($make_err) && empty($model_err) && empty($year_err) && empty($date_err) && empty($service_err)) {
        $sql = "INSERT INTO reservation (nom, prenom, email, numero, adresse, service, marque, modele, annee_prod, date_reservation, commentaire) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare the statement
        $stmt = mysqli_prepare($database, $sql);

        // Bind the parameters with the actual values
        mysqli_stmt_bind_param($stmt, "sssssssssss", $_POST["last-name"], $_POST["first-name"], $_POST["email"], $_POST["tel"], $_POST["adress"], $_POST["services"], $_POST["make"], $_POST["model"], $_POST["year"], $_POST["date"], $_POST["commentaire"]);

        mysqli_stmt_execute($stmt);
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Réservation - Mechanic2U</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link rel="stylesheet" href="../style/media.css">
    <link rel="stylesheet" href="../style/booking.css">
</head>

<body id="reservation">

    <?php
    include_once './includes/header.php';
    ?>

    <!-- booking section-->
    <section class="booking">
        <div class="content">
            <h1 class="booking-title">Réservez votre service</h1>
            <h2 class="required">* Vous devez être connecté pour réserver un service</h2>


            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="row">
                    <div class="form-group">
                        <span>Nom</span>
                        <input type="text" name="last-name" placeholder="Nom" class="box"
                            class="form-control <?php echo (!empty($lastname_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $lname; ?>">
                        <span class="error">
                            <?php echo $lastname_err; ?>
                        </span>
                    </div>

                    <div class="form-group">
                        <span>Prénom</span>
                        <input type="text" name="first-name" placeholder="Prénom" class="box"
                            class="form-control <?php echo (!empty($firstname_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $fname; ?>">
                        <span class="error">
                            <?php echo $firstname_err; ?>
                        </span>

                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <span><i class="fa-solid fa-envelope"></i> Adresse e-mail</span>
                        <input type="text" name="email" placeholder="Ex: nom@domaine.com" class="box"
                            class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $email; ?>">
                        <span class="error">
                            <?php echo $email_err; ?>
                        </span>

                    </div>
                    <div class="form-group">
                        <span><i class="fa-solid fa-phone"></i> Numéro de téléphone</span>
                        <input type="text" name="tel" maxlength="10" placeholder="(+213) 0y xx xx xx xx" class="box"
                            class="form-control <?php echo (!empty($tel_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $tel; ?>">
                        <span class="error">
                            <?php echo $tel_err; ?>
                        </span>

                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <span>Adresse</span>
                        <input type="text" name="adress" placeholder="Entrez votre adresse" class="box"
                            class="form-control <?php echo (!empty($adress_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $adress; ?>">
                        <span class="error">
                            <?php echo $adress_err; ?>
                        </span>

                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <span>Marque:</span>
                        <input type="text" name="make" placeholder="Entrez la marque de votre véhicule" class="box"
                            class="form-control <?php echo (!empty($make_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $make; ?>">
                        <span class="error">
                            <?php echo $make_err; ?>
                        </span>
                    </div>
                    <div class="form-group">
                        <span>Modèle:</span>
                        <input type="text" name="model" placeholder="Entrez le modèle de votre véhicule" class="box"
                            class="form-control <?php echo (!empty($model_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $model; ?>">
                        <span class="error">
                            <?php echo $model_err; ?>
                        </span>

                    </div>
                    <div class="form-group">
                        <span>Année de production:</span>
                        <input type="number" min="1900" max="2023" step="1"
                            placeholder="Entrez l'année de production de votre véhicule" name="year" class="box"
                            class="form-control <?php echo (!empty($year_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $year; ?>">
                        <span class="error">
                            <?php echo $year_err; ?>
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <span><i class="fa-brands fa-servicestack"></i> Service:</span>
                        <select name="services" class="box" id="services">
                            <option value="Sélectionnez une prestation" disabled selected>Sélectionnez une
                                prestation</option>
                            <optgroup label="Prestations Fréquentes">
                                <option value="Remplacement Disques & Plaquettes AV">Remplacement Disques & Plaquettes
                                    AV</option>
                                <option value="Remplacement Plaquettes AV">Remplacement Plaquettes AV</option>
                                <option value="Vidange de Base (filtre à huile)">Vidange de Base (filtre à huile)
                                </option>
                            </optgroup>
                            <optgroup label="Direction & Transmission">
                                <option value="Remplacement de biellettes de direction">Remplacement de biellettes de
                                    direction</option>
                                <option value="Remplacement de cardan">Remplacement de cardan</option>
                                <option value="Remplacement de cardan et soufflet de cardan">Remplacement de cardan et
                                    soufflet de cardan</option>
                                <option value="Remplacement rotule direction avant droit">Remplacement rotule direction
                                    avant droit</option>
                                <option value="Remplacement rotule direction avant gauche">Remplacement rotule direction
                                    avant gauche</option>
                            </optgroup>
                            <optgroup label="Moteur">
                                <option value="Décalaminage Moteur">Décalaminage Moteur</option>
                                <option value="Problème d’allumage du Moteur">Problème d’allumage du Moteur</option>
                                <option value="Remplacement des Bougies">Remplacement des Bougies</option>
                                <option value="Remplacement du filtre à air">Remplacement du filtre à air</option>
                                <option value="Remplacement filtre à carburant gasoil et essence">Remplacement filtre à
                                    carburant gasoil et essence</option>
                                <option value="Remplacement injecteur">Remplacement injecteur</option>
                                <option value="Remplacement injecteur (tous)">Remplacement injecteur (tous)</option>
                            </optgroup>
                            <optgroup label="Éclairage et visibilité">
                                <option value="Changement des Phares et Optiques">Changement des Phares et Optiques
                                </option>
                                <option value="Remplacement d'ampoule de phare">Remplacement d'ampoule de phare</option>
                                <option value="Remplacement du feu arrière droit">Remplacement du feu arrière droit
                                </option>
                                <option value="Remplacement du feu arrière gauche">Remplacement du feu arrière gauche
                                </option>
                                <option value="Remplacement du phare avant gauche">Remplacement du phare avant gauche
                                </option>
                            </optgroup>
                            <optgroup label="Suspension">
                                <option value="Remplacement Amortisseur AV">Remplacement Amortisseur AV</option>
                                <option value="Remplacement d'une rotule de suspension">Remplacement d'une rotule de
                                    suspension</option>
                                <option value="Remplacement de biellettes de suspension">Remplacement de biellettes de
                                    suspension</option>
                                <option value="Remplacement triangle ou bras de suspension">Remplacement triangle ou
                                    bras de suspension</option>
                            </optgroup>
                            <optgroup label="Échappement">
                                <option value="Remplacement de vanne EGR">Remplacement de vanne EGR</option>
                                <option value="Remplacement du catalyseur d’échappement">Remplacement du catalyseur
                                    d’échappement</option>
                                <option value="Remplacement filtre à particule (FAP)">Remplacement filtre à particule
                                    (FAP)</option>
                                <option value="Remplacement Silencieux Arrière / Pot d’Échappement">Remplacement
                                    Silencieux Arrière / Pot d’Échappement</option>
                            </optgroup>
                            <optgroup label="Embrayage">
                                <option value="Changement kit d'embrayage et volant moteur">Changement kit d'embrayage
                                    et volant moteur</option>
                                <option value="Problème d'embrayage">Problème d'embrayage</option>
                                <option value="Remplacement Kit Embrayage">Remplacement Kit Embrayage</option>
                            </optgroup>
                            <optgroup label="Pneus/Roues">
                                <option value="Changement de pneus avant et arrière">Changement de pneus avant et
                                    arrière</option>
                                <option value="Contrôle du Parallélisme et Géométrie">Contrôle du Parallélisme et
                                    Géométrie</option>
                                <option value="Équilibrage des Pneus">Équilibrage des Pneus</option>
                                <option value="Remplacement de roulement de roue">Remplacement de roulement de roue
                                </option>
                            </optgroup>
                            <optgroup label="Freinage">
                                <option value="Remplacement de câble de frein à main">Remplacement de câble de frein à
                                    main</option>
                                <option value="Remplacement Disques & Plaquettes AR">Remplacement Disques & Plaquettes
                                    AR</option>
                                <option value="Remplacement liquide de freins">Remplacement liquide de freins</option>
                                <option value="Remplacement Plaquettes AR">Remplacement Plaquettes AR</option>
                            </optgroup>
                            <optgroup label="Batterie, alternateur et démarreur">
                                <option value="Problème d'Alternateur">Problème d'Alternateur</option>
                                <option value="Remplacement d’alternateur">Remplacement d’alternateur</option>
                                <option value="Remplacement de Démarreur">Remplacement de Démarreur</option>
                                <option value="Remplacement de la Batterie">Remplacement de la Batterie</option>
                            </optgroup>
                            <optgroup label="Climatisation & Chauffage">
                                <option value="Entretien de la Climatisation">Entretien de la Climatisation</option>
                                <option value="Entretien et Recharge de la Clim">Entretien et Recharge de la Clim
                                </option>
                                <option value="Problème de Chauffage">Problème de Chauffage</option>
                                <option value="Remplacement du filtre d'habitacle">Remplacement du filtre d'habitacle
                                </option>
                            </optgroup>
                            <optgroup label="Remplacement des vitres">
                                <option value="Remplacement du pare-brise">Remplacement du pare-brise</option>
                                <option value="Réparation des éclats">Réparation des éclats</option>
                            </optgroup>
                            <optgroup label="Ditribution">
                                <option value="Changement du kit de distribution">Changement du kit de distribution
                                </option>
                                <option value="Remplacement de la courroie de distribution">Remplacement de la courroie
                                    de distribution</option>
                            </optgroup>
                            <optgroup label="Diagnostics">
                                <option value="Diagnostic électronique automobile">Diagnostic électronique automobile
                                </option>
                            </optgroup>
                            <optgroup label="Refroidissement">
                                <option value="Remplacement liquide de refroidissement">Remplacement liquide de
                                    refroidissement</option>
                            </optgroup>
                        </select>
                        <span class="error">
                            <?php echo $service_err; ?>
                        </span>
                    </div>

                    <div class="form-group">
                        <span><i class="fa-solid fa-calendar-days"></i> Choisissez la date de votre
                            rendez-vous</span>
                        <input type="text" name="date" id="date" class="box"
                            class="form-control <?php echo (!empty($date_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $date; ?>">
                        <span class="error">
                            <?php echo $date_err; ?>
                        </span>
                    </div>

                </div>
                <div class="row">
                    <div class="form-group">
                        <span for="message">Veuillez vous fournir des détails supplémentaires?
                        </span>
                        <textarea name="commentaire" cols="" rows=""></textarea>
                    </div>
                </div>

                <div class="form-footer" align="center">
                    <input type="submit" class="book-btn" value="Envoyer">
                    <input type="reset" class="book-btn" value="Réinitialiser">
                    <p>Vous n'êtes pas encore connecté? <a href="./authentification/login.php">Connectez-vous
                            ici</a>.
                    </p>
                </div>
            </form>

        </div>
    </section>

    <?php
    include_once './includes/footer.php';
    ?>
    <script>$('#date').datepicker({

            changeMonth: true,

            duration: 'fast',

            changeYear: true,

            numberOfMonths: 1,

            selectOtherMonths: true,

            showOtherMonths: true,

            minDate: 0, //Disable to choose previous dates

        });</script>
</body>

</html>