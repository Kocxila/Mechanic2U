<?php

session_start();
$error = $nomErr = $prenomErr = $emailErr = $error3 = $numeroErr = $passwordErr = $cpasswordErr = $error2 = "";

include("../includes/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lname = $_POST['last-name'];
    $fname = $_POST['first-name'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirm_password'];

    if (empty($lname)) {
        $nomErr = "Nom obligatoire.";
    } elseif (!preg_match('/^[a-zA-Z]*$/', $lname)) {
        $nomErr = "Votre nom doit seulement contenir des lettres.";
    }

    if (empty($fname)) {
        $prenomErr = "Prénom obligatoire.";
    } elseif (!preg_match('/^[a-zA-Z]*$/', $fname)) {
        $prenomErr = "Votre prénom doit seulement contenir des lettres.";
    }

    if (empty($tel)) {
        $numeroErr = "Entrez un numéro de téléphone.";
    } elseif (!preg_match('/^[0-9]{10}+$/', $tel)) {
        $numeroErr = "Veuillez saisir un numéro de téléphone valide.";
    }

    if (empty($password)) {
        $passwordErr = "Mot de passe obligatoire.";
    }

    if (empty($cpassword)) {
        $cpasswordErr = "Veuillez remplir ce champ obligatoire.";
    }

    if (empty($email)) {
        $emailErr = "Veuillez saisir une adresse e-mail.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error3 = "Le format de l'adresse e-mail saisie n'est pas valide.";
    } else {
        if ($password !== $cpassword) {
            $cpasswordErr = "Veuillez confirmer le mot de passe correctement.";
        } else {
            $result = $database->query("SELECT * FROM utilisateurs WHERE email_utilisateur='$email';");
            if ($result->num_rows > 0) {
                $error = "Un compte existe déjà avec cette adresse e-mail.";
            } else {
                $param_password = password_hash($password, PASSWORD_DEFAULT);
                $insert_result = $database->query("INSERT INTO utilisateurs(nom_utilisateur, prenom_utilisateur, email_utilisateur, tel_utilisateur, mdp_utilisateur) VALUES ('$lname','$fname','$email','$tel','$param_password');");
                // Effacer le message d'erreur
                $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>';
                // Définir les paramètres de session pour être redirigé vers la page correcte
                $_SESSION["logged_in"] = true;
                $_SESSION["user_id"] = $database->insert_id;
                $_SESSION["email"] = $email;
                $_SESSION["last_name"] = $lname;
                $_SESSION["first_name"] = $fname;
                // Redirection
                header('location: roles.php');
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
    <title>Inscription - Mechanic2U</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../style/register.css">
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
    <section class="signup">
        <div class="image">
            <img src="../../images/signup.svg">
        </div>
        <div class="content">
            <h3>Créer votre compte</h3>
            <form method="POST">
                <div class="row">

                    <div class="form-group">
                        <span>Nom</span>
                        <input type="text" name="last-name" placeholder="Nom" class="box">
                        <div class="error">
                            <?php echo $nomErr ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <span>Prénom</span>
                        <input type="text" name="first-name" placeholder="Prénom" class="box">
                        <div class="error">
                            <?php echo $prenomErr ?>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="form-group">
                        <span><i class="fa-solid fa-envelope"></i> Adresse e-mail</span>
                        <input type="text" name="email" placeholder="Ex: nom@domaine.com" class="box">
                        <div class="error">
                            <?php echo $emailErr ?>
                            <?php echo $error3 ?>
                            <?php echo $error ?>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="form-group">
                        <span><i class="fa-solid fa-phone"></i> Numéro de téléphone</span>
                        <input type="text" name="tel" maxlength="10" placeholder="(+213) 0y xx xx xx xx" class="box">
                        <div class="error">
                            <?php echo $numeroErr ?>
                        </div>
                    </div>


                </div>

                <div class="row">
                    <div class="form-group">
                        <span>
                            <i class="fa-solid fa-lock"></i> Mot de passe
                        </span>
                        <input type="password" name="password" placeholder="Mot de passe" class="box" id="password">
                        <div class="error" >
                            <?php echo $passwordErr ?>
                            
                        </div>
                        <span id="passwordError" style="color: red;"></span>

                    </div>


                    <div class="form-group">
                        <span>Confirmation</span>
                        <input type="password" name="confirm_password" placeholder="Confirmer" class="box">
                        <div class="error">
                            <?php echo $cpasswordErr ?>
                            <?php echo $error2 ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div align="center" class="form-footer">
                        <input type="submit" class="btn" value="Inscription" onclick="validateForm(event)">
                        <input type="reset" class="btn" value="Réinitialiser">
                        <p>Vous avez déjà un compte? <a href="./login.php">Connectez-vous ici</a>.
                        </p>
                    </div>
                </div>
            </form>

        </div>
    </section>
    <script>
        function validateForm(event) {
          var password = document.getElementById('password').value;
          var passwordError = document.getElementById('passwordError');
      
          if (password.length < 8) {
              passwordError.textContent = "Le mot de passe doit comporter au moins six caractères.";
              event.preventDefault(); // Prevent form submission
          } else {
              passwordError.textContent = ""; // Clear the error message
           }
        }
   </script>
</body>

</html>