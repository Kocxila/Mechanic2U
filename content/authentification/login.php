<?php

// Initialize the session

session_start();

// Check if the user is already logged in, if yes then redirect him to the welcome page
if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) {
    header("location: ../../index.php");
    exit;
}

$error1 = $error2 = $error3 = "";

// Include config file
require_once "../includes/config.php";

if ($_POST) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email and password are empty
    if (empty($email) || empty($password)) {
        $error2 = "Veuillez saisir l'adresse e-mail et le mot de passe";
    } else {

        // Validate email syntax
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error3 = "Le format de l'adresse e-mail saisie n'est pas valide";
        } else {

            // Query the user account
            $query = "SELECT id_utilisateur, nom_utilisateur, prenom_utilisateur, email_utilisateur, tel_utilisateur, mdp_utilisateur FROM utilisateurs WHERE email_utilisateur = '$email'";
            $result = $database->query($query);

            // If a matching user account is found, verify the password
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row['mdp_utilisateur'])) {
                    $_SESSION['logged_in'] = true;
                    $_SESSION['user_id'] = $row['id_utilisateur'];
                    $_SESSION['email'] = $row['email_utilisateur'];
                    $_SESSION['first_name'] = $row['prenom_utilisateur'];
                    $_SESSION['last_name'] = $row['nom_utilisateur'];
                    $_SESSION['tel'] = $row['tel_utilisateur'];

                    header("Location: roles.php");
                    exit;
                } else {
                    // If the login details are invalid, show an error message
                    $error1 = " Adresse e-mail ou mot de passe invalide";
                }
            } else {
                // If the login details are invalid, show an error message
                $error1 = " Adresse e-mail ou mot de passe invalide";
            }
        }
    }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Connexion - Mechanic2U</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../style/login.css">
    <link rel="stylesheet" href="../../style/media.css">
    <link rel="stylesheet" href="../../style/header.css">
</head>


<body>
    <header class="header">

        <section class="flex">

            <a href="../../index.php" class="logo"><i class="fa-solid fa-screwdriver-wrench"></i>
                Mechanic<span>2U</span></a>
        </section>
    </header>

    <!-- Login section-->
    <section class="login">
        <div class="image">
            <img src="../../images/login.svg">
        </div>
        <div class="content">
            <h3>Connexion</h3>
            <?php
            if (!empty($login_err)) {
                echo '<div class="alert alert-danger">' . $login_err . '</div>';
            }
            ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <span>
                    <i class="fa-solid fa-user"></i>
                    Adresse e-mail
                </span>



                <input type="text" name="email" placeholder="Entrez votre adresse e-mail" class="box"
                    class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>"
                    value="<?php //echo $email; ?>">
                <span class="error">
                    <?php echo $error3 ?>
                </span><br>

                <span><i class="fa-solid fa-lock"></i> Mot de passe:</span>
                <input type="password" name="password" placeholder="Entrez votre mot de passe" class="box">
                <span class="error">
                    <?php echo $error2 ?>
                    <?php echo $error1 ?>
                </span>
                <input type="submit" value="Connexion" name="submit" class="login-btn">

                <p align="center">Vous n'avez pas de compte ? <a href="./register.php">Inscrivez-vous maintenant</a>
                </p>
            </form>

        </div>
    </section>

</body>

</html>