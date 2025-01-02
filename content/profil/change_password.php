<?php
include '../includes/config.php';


if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) {
    $logged_in = true;
    $lname = ucfirst(strtolower($_SESSION["last_name"]));
    $fname = ucfirst(strtolower($_SESSION["first_name"]));

    // Initialize the session
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
        $id = $_SESSION['user_id'];
        $query = mysqli_query($database, "SELECT * FROM utilisateurs where id_utilisateur='$id'");
        $row = mysqli_fetch_array($query);
    }

} else {
    $logged_in = false;
    $lname = '';
    $fname = '';
    $id = '';
}



if (isset($_POST['update_password'])) {

    $old_pass = $_POST['old_pass'];
    $update_pass = $_POST['update_pass'];

    $new_pass = $_POST['new_pass'];
    $confirm_pass = $_POST['confirm_pass'];

    if (!empty($update_pass) && !empty($new_pass) && !empty($confirm_pass)) {

        if (!password_verify($update_pass, $old_pass)) {
            $message[] = "Le mot de passe actuel ne correspond pas !";

        } elseif ($new_pass != $confirm_pass) {
            $message[] = 'Veuillez confirmer le mot de passe correctement.';

        } else {
            $param_password = password_hash($confirm_pass, PASSWORD_DEFAULT);
            mysqli_query($database, "UPDATE `utilisateurs` SET mdp_utilisateur = '$param_password' WHERE id_utilisateur = '$id'") or die('query failed');
            $message[] = 'Mot de passe mis à jour avec succès !';
        }

    } else {
        $message[] = 'Veuillez remplir tous les champs!';

    }
}
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Changer mon mot de passe - Mechanic2U</title>
    <link rel="stylesheet" href="../../style/dashboard.css">
    <link rel="stylesheet" href="../../style/change_password.css">
</head>

<body>

    <?php
    include_once 'sidebar.php';
    ?>

    <section class="home-section">
        <div class="header">
            <div class="text">Modifier le mot de passe</div>
        </div>
        <div class="pass">
            <div class="content">
                <?php
                $select = mysqli_query($database, "SELECT * FROM `utilisateurs` WHERE id_utilisateur = '$id'") or die('query failed');
                if (mysqli_num_rows($select) > 0) {
                    $fetch = mysqli_fetch_assoc($select);
                }
                ?>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <?php
                    if (isset($message)) {
                        foreach ($message as $message) {
                            echo '<div class="message">' . $message . '</div>';
                        }
                    }
                    ?>
                    <input type="hidden" name="old_pass" value="<?php echo $fetch['mdp_utilisateur']; ?>">
                    <div class="row">
                        <div class="form-group">
                            <span>Mot de passe actuel :</span>
                            <p>Pour changer de mot de passe, entrez d'abord votre mot de passe actuel.</p>
                            <input type="password" name="update_pass" class="box">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <span>Nouveau mot de passe :</span>
                            <p>Choisissez un nouveau mot de passe.</p>
                            <input type="password" name="new_pass" minlength="8" class="box">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <span>Confirmez le nouveau mot de passe :</span>
                            <p>Il doit correspondre au mot de passe dans le champ précédent.</p>
                            <input type="password" name="confirm_pass" minlength="8" class="box">
                        </div>
                    </div>
                    <div class="form-footer" align="center">
                        <input type="submit" name="update_password" minlength="8" class="pass-btn"
                            value="Sauvegarder les modifications">
                    </div>
                </form>
            </div>
        </div>

    </section>

    <script src="../../script/dashboard.js"></script>

</body>

</html>