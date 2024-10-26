<?php
// Include config file
require_once "./includes/config.php";

// Define variables and initialize with empty values
$nom = $prenom = $email = $numero = $sexe = $ville = $identite = $diplome = "";
$nomErr = $prenomErr = $emailErr = $numeroErr = $sexeErr = $villeErr = $identiteErr = $diplomeErr = "";

// Initialize the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) {
        $id = $_SESSION['user_id'];
        $query = mysqli_query($database, "SELECT * FROM utilisateurs where id_utilisateur='$id'");
        $row = mysqli_fetch_array($query);
        $nom = $row['nom_utilisateur'];
        $prenom = $row['prenom_utilisateur'];
        $email = $row['email_utilisateur'];
        $numero = $row['tel_utilisateur'];
    } else {
        $logged_in = false;
    }
}


// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
        echo "<script>alert('Vous devez être connecté pour envoyer les données.');</script>";
        header("location: ./authentification/login.php");
        exit; // Arrête l'exécution du script
    }


    // Validate email
    if (empty(trim($_POST["email"]))) {
        $emailErr = "Entrez une adresse e-mail.";
    } elseif (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", trim($_POST["email"]))) {
        $emailErr = "Le format de l'adresse e-mail saisie n'est pas valide";
    } else {
        // Prepare a select statement
        $sql = "SELECT id_preinscription FROM preinscription WHERE email = ?";

        if ($stmt = mysqli_prepare($database, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // store result 
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    //$emailErr = "Cette adresse e-mail est déja utilisé. Essayez une autre.";
                    $emailErr = '<script>alert("Cette adresse e-mail est déja utilisé. Essayez une autre.");</script>';
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Oops! Une erreur est survenue. Veuillez réessayer plus tard.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

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

    // Validate Sexe
    if (empty($_POST["sexe"]) || $_POST["sexe"] == "sexe") {
        $sexeErr = "Sexe obligatoire.";
    } else {
        $sexe = trim($_POST["sexe"]);
    }
    // Validate Ville
    if (empty($_POST["ville"]) || $_POST["ville"] == "ville") {
        $villeErr = "Ville obligatoire.";
    } else {
        $ville = trim($_POST["ville"]);
    }
    // Validate Identite
    if (empty($_POST["identite"])) {
        $identiteErr = "Veuillez remplir ce champ obligatoire.";
    } else {
        $identite = trim($_POST["identite"]);
    }
    // Validate Diplome
    if (empty($_POST["diplome"])) {
        $diplomeErr = "Veuillez remplir ce champ obligatoire.";
    } else {
        $diplome = trim($_POST["diplome"]);
    }

    // Check input errors before inserting in database
    if (empty($nomErr) && empty($prenomErr) && empty($emailErr) && empty($numeroErr) && empty($sexeErr) && empty($villeErr) && empty($identiteErr) && empty($diplomeErr)) {

        // Prepare an insert statement
        $sql = "INSERT INTO preinscription (nom, prenom, email, numero, sexe, ville, num_CNI, annee_diplome) VALUES (?, ?, ?, ?, ?, ?, ? ,?)";

        if ($stmt = mysqli_prepare($database, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssss", $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['numero'], $_POST['sexe'], $_POST['ville'], $_POST['identite'], $_POST['diplome']);
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: ./join_us.php");
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../style/media.css">
    <link rel="stylesheet" href="../style/join_us.css">
    <title>Rejoignez l'équipe Mechanic2U</title>
</head>

<body>
    <?php
    include_once './includes/header.php';
    ?>

    <div class="heading" style="background:url(../images/background.jpg) no-repeat">
        <h1>Rejoindre notre équipe</h1>
    </div>
    <!--inscription section-->
    <section class="register ">
        <div class="content">
            <h1 class="register-title">Inscrivez-vous maintenant!</h1>
            <h2 class="required">* Vous devez être connecté pour remplir la demande d'inscription.</h2>
            <form action="join_us.php" method="post">
                <div class="row">
                    <div class="form-group">
                        <span>Nom</span>
                        <input type="text" name="nom" placeholder="Nom" class="box" value="<?php echo $nom; ?>">
                        <span class="error">
                            <?php echo $nomErr; ?>
                        </span>
                    </div>
                    <div class="form-group">
                        <span>Prénom</span>
                        <input type="text" name="prenom" placeholder="Prénom" class="box"
                            value="<?php echo $prenom; ?>">
                        <span class="error">
                            <?php echo $prenomErr; ?>
                        </span>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <span><i class="fa-solid fa-envelope"></i> Adresse e-mail</span>
                        <input type="text" name="email" placeholder="Ex: nom@domaine.com" class="box"
                            value="<?php echo $email; ?>">
                        <span class="error">
                            <?php echo $emailErr; ?>
                        </span>
                    </div>

                    <div class="form-group">
                        <span><i class="fa-solid fa-phone"></i> Numéro de téléphone</span>
                        <input type="text" name="numero" maxlength="10" placeholder="(+213) 0y xx xx xx xx" class="box"
                            value="<?php echo $numero; ?>">
                        <span class="error">
                            <?php echo $numeroErr; ?>
                        </span>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <span><i class="fa-solid fa-people-arrows"></i> Quel est votre sexe?</span>
                        <select name="sexe" class="box">
                            <option value="sexe" selected disabled>Votre sexe</option>
                            <option value="Homme">Homme</option>
                            <option value="Femme">Femme</option>
                        </select>
                        <span class="error">
                            <?php echo $sexeErr; ?>
                        </span>
                    </div>
                    <div class="form-group">
                        <span><i class="fa-solid fa-location-dot"></i> Votre ville? </span>
                        <select name="ville" class="box">
                            <option value="ville" selected disabled>Votre ville</option>
                            <optgroup label="Tizi-Ouzou">
                                <option value="Abi Youcef">Abi Youcef</option>
                                <option value="Aghribs">Aghribs</option>
                                <option value="Agouni Gueghrane">Agouni Gueghrane</option>
                                <option value="Aïn El Hammam">Aïn El Hammam</option>
                                <option value="Aïn Zaouia">Aïn Zaouia</option>
                                <option value="Aït Aïssa Mimoun">Aït Aïssa Mimoun</option>
                                <option value="Aït Bouaddou">Aït Bouaddou</option>
                                <option value="Aït Boumahdi">Aït Boumahdi</option>
                                <option value="Aït Chafâa">Aït Chafâa</option>
                                <option value="Aït Aggouacha">Aït Aggouacha</option>
                                <option value="Aït Khelili">Aït Khelili</option>
                                <option value="Aït Mahmoud">Aït Mahmoud</option>
                                <option value="Aït Ouacif">Aït Ouacif</option>
                                <option value="Aït Oumalou">Aït Oumalou</option>
                                <option value="Aït Toudert">Aït Toudert</option>
                                <option value="Aït Yahia">Aït Yahia</option>
                                <option value="Aït Yahia Moussa">Aït Yahia Moussa</option>
                                <option value="Aït Ziki">Aït Ziki</option>
                                <option value="Akbil">Akbil</option>
                                <option value="Akerrou">Akerrou</option>
                                <option value="Assi Youcef">Assi Youcef</option>
                                <option value="Assi Ameur">Assi Ameur</option>
                                <option value="Ath Zikki">Ath Zikki</option>
                                <option value="Azazga">Azazga</option>
                                <option value="Azeffoun">Azeffoun</option>
                                <option value="Azrou Nethor">Azrou Nethor</option>
                                <option value="Beni Aïssi">Beni Aïssi</option>
                                <option value="Beni Douala">Beni Douala</option>
                                <option value="Beni Yenni">Beni Yenni</option>
                                <option value="Beni Zmenzer">Beni Zmenzer</option>
                                <option value="Boghni">Boghni</option>
                                <option value="Boudjima">Boudjima</option>
                                <option value="Bounouh">Bounouh</option>
                                <option value="Bouzeguène">Bouzeguène</option>
                                <option value="Darguina">Darguina</option>
                                <option value="Draâ El Mizan">Draâ El Mizan</option>
                                <option value="Draâ Ben Khedda">Draâ Ben Khedda</option>
                                <option value="Freha">Freha</option>
                                <option value="Frikat">Frikat</option>
                                <option value="Iboudraren">Iboudraren</option>
                                <option value="Idjeur">Idjeur</option>
                                <option value="Iferhounène">Iferhounène</option>
                                <option value="Ifigha">Ifigha</option>
                                <option value="Iflissen">Iflissen</option>
                                <option value="Ighil Ali">Ighil Ali</option>
                                <option value="Iguer Rmalen">Iguer Rmalen</option>
                                <option value="Illilten">Illilten</option>
                                <option value="Illoula Oumalou">Illoula Oumalou</option>
                                <option value="Imkiren">Imkiren</option>
                                <option value="Imsouhal">Imsouhal</option>
                                <option value="Irdjen">Irdjen</option>
                                <option value="Larbaâ Nath Irathen">Larbaâ Nath Irathen</option>
                                <option value="Mâatkas">Mâatkas</option>
                                <option value="Makouda">Makouda</option>
                                <option value="Mechtras">Mechtras</option>
                                <option value="Mekla">Mekla</option>
                                <option value="Mizrana">Mizrana</option>
                                <option value="Ouadhias">Ouadhias</option>
                                <option value="Ouaguenoun">Ouaguenoun</option>
                                <option value="Oued Aïssi">Oued Aïssi</option>
                                <option value="Sidi Namane">Sidi Namane</option>
                                <option value="Souamaâ">Souamaâ</option>
                                <option value="Souk El Thenine">Souk El Thenine</option>
                                <option value="Tadmait">Tadmait</option>
                                <option value="Tala Athmane">Tala Athmane</option>
                                <option value="Tamokra">Tamokra</option>
                                <option value="Tigzirt">Tigzirt</option>
                                <option value="Timizart">Timizart</option>
                                <option value="Tirmitine">Tirmitine</option>
                                <option value="Tizi Gheniff">Tizi Gheniff</option>
                                <option value="Tizi N'Tleta">Tizi N'Tleta</option>
                                <option value="Tizi Ouzou ">Tizi Ouzou</option>
                                <option value="Tizi Rached">Tizi Rached</option>
                                <option value="Yakouren">Yakouren</option>
                                <option value="Yatafen">Yatafen</option>
                                <option value="Zekri">Zekri</option>
                            </optgroup>
                        </select>
                        <span class="error">
                            <?php echo $villeErr; ?>
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <span><i class="fa-regular fa-id-card"></i> Numéro de CNI :</span>
                        <input type="text" maxlength="25" name="identite"
                            placeholder="Saisissez votre numéro d'identification national" class="box">
                        <span class="error">
                            <?php echo $identiteErr; ?>
                        </span>
                    </div>
                    <div class="form-group">
                        <span><i class="fa-regular fa-file-image"></i> Année d'obtention du diplome :</span>
                        <input type="number" min="1500" max="2023" step="1" name="diplome"
                            placeholder="Saisissez votre année d'obtention du diplome" class="box">
                        <span class="error">
                            <?php echo $diplomeErr; ?>
                        </span>

                    </div>
                </div>
                <div align="center" class="form-footer">
                    <input type="submit" value="Envoyer" class="register-btn" name="send">
                    <input type="reset" class="register-btn" value="Réinitialiser">
                    <p>Vous n'êtes pas encore connecté? <a href="./authentification/login.php">Connectez-vous
                            ici</a>.
                    </p>
                </div>
            </form>
        </div>
    </section>

    <!-- Comment devenir mecanicien-->

    <section class="Howto">
        <h1 class="heading-title">Comment devenir mécanicien chez Mechanic<span>2U?</span></h1>

        <div class="content">
            <div class="row">
                <div class="text">
                    <h1 class="title"><i class="fa-solid fa-1"></i>. Inscription</h1>
                    <p>Inscrivez-vous sur notre page web et remplissez
                        toutes les informations nécessaires.</p>
                </div>
                <div>
                    <img src="../images/join_team/form.png" alt="form" class="img">
                </div>
            </div>

            <div class="row">
                <div>
                    <img src="../images/join_team/confirm.png" alt="confirm" class="img">
                </div>
                <div class="text">
                    <h1 class="title"><i class="fa-solid fa-2"></i>. Validation</h1>
                    <p>Votre dossier est transmis à nos équipes afin
                        d'être vérifié et étudié.</p>
                </div>
            </div>

            <div class="row">
                <div class="text">
                    <h1 class="title"><i class="fa-solid fa-3"></i>. Interview</h1>
                    <p>Après la validation de votre dossier, nous vous contacterons
                        pour fixer un rendez-vous pour une interview en ligne ou en personne
                        afin de mieux comprendre votre profil et déterminer si vous êtes un candidat potentiel pour
                        rejoindre notre équipe.
                    </p>
                </div>
                <div>
                    <img src="../images/join_team/call.png" alt="" class="img">
                </div>
            </div>
            <div class="row">
                <div>
                    <img src="../images/join_team/notif.png" alt="notif" class="img">
                </div>
                <div class="text">
                    <h1 class="title"><i class="fa-solid fa-4"></i>. Félicitations</h1>
                    <p>Bravo! Vous êtes maintenant mecanicien Mechanic2u.
                        Vous pouvez maintenant activer votre application et
                        gagner de l'argent.</p>
                </div>
            </div>
        </div>
    </section>>

    <!-- reviews-->
    <section class="reviews">
        <h3>CE QUE NOS MÉCANICIENS PARLENT DE NOUS</h3>
        <div class="swiper reviews-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide slide">
                    <h3>Utilisateur1</h3>
                    <img src="../images/user.png" alt="">
                    <span>Mécanicien</span>
                    <p>"En tant que mécanicien, j'adore utiliser Mechanic2U. C'est un
                        excellent moyen d'entrer en contact avec les clients et de
                        leur offrir la commodité des réparations mobiles. Le site
                        est conviviale et me permet de gérer facilement mes rendez-vous
                        et mes ordres de travail. Je recommande vivement ce site à
                        mes collègues mécaniciens !"
                    </p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <div class="swiper-slide slide">
                    <h3>Utilisateur2</h3>
                    <img src="../images/user.png" alt="">
                    <span>Mécanicien</span>
                    <p>"Je suis mécanicien depuis plus de 20 ans et Mechanic2U est l'avenir
                        de l'industrie. Le site permet d'atteindre facilement de nouveaux
                        clients et de développer mon activité. L'équipe d'assistance est
                        également très réactive et serviable. C'est une solution gagnante
                        pour les mécaniciens et les clients."
                    </p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <div class="swiper-slide slide">
                    <h3>Utilisateur3</h3>
                    <img src="../images/user.png" alt="">
                    <span>Mécanicien</span>
                    <p>"J'hésitais à m'inscrire à un site de mécanique mobile, mais après
                        avoir utilisé Mechanic2U pendant quelques mois, je suis heureux de
                        l'avoir fait. Le site rationalise l'ensemble du processus de réparation
                        et facilite la communication avec les clients. J'ai également constaté une
                        augmentation de mon chiffre d'affaires depuis que j'ai rejoint la plateforme.
                        Je le recommande vivement !"
                    </p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <div class="swiper-slide slide">
                    <h3>Utilisateur4</h3>
                    <img src="../images/user.png" alt="">
                    <span>Mécanicien</span>
                    <p>"Mechanic2U a changé la donne pour mon entreprise. Le site m'a aidé à étendre
                        ma portée et à fournir mes services à des clients qui ne m'auraient pas trouvé
                        autrement. Le système de paiement est également très pratique et me permet d'être
                        payé à temps. Dans l'ensemble, c'est une excellente plateforme pour les mécaniciens !"

                    </p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <div class="swiper-slide slide">
                    <h3>Utilisateur5</h3>
                    <img src="../images/user.png" alt="">
                    <span>Mécanicien</span>
                    <p>"J'utilise Mechanic2U depuis un an maintenant, et j'ai été impressionné par la qualité
                        des clients et le soutien de l'équipe. Le site est facile à utiliser et facilite la
                        gestion de mes rendez-vous et de mes ordres de travail. Je recommanderais sans hésiter
                        ce site à d'autres mécaniciens désireux de développer leur activité."

                    </p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>

                </div>
                <div class="swiper-slide slide">
                    <h3>Utilisateur6</h3>
                    <img src="../images/user.png" alt="">
                    <span>Mécanicien</span>
                    <p>"Mechanic2U est une plateforme formidable pour les mécaniciens qui apprécient la flexibilité
                        et l'indépendance. J'ai pu me constituer une clientèle fidèle grâce au site et recevoir des
                        commentaires positifs de la part de clients satisfaits. Dans l'ensemble, c'est une excellente
                        plateforme pour les mécaniciens qui cherchent à développer leur activité."

                    </p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>


    <?php
    include_once './includes/footer.php';
    ?>

    <div id="return-to-top">
        <i class="fas fa-arrow-up-long"></i>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="../script/join_us.js"></script>
    <script src="../script/button.js"></script>

</body>

</html>