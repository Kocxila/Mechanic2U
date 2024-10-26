<?php
include '../includes/config.php';
?>
<?php


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
        $nom = $row['nom_utilisateur'];
        $prenom = $row['prenom_utilisateur'];
        $email = $row['email_utilisateur'];
        $numero = $row['tel_utilisateur'];
    }

} else {
    $logged_in = false;
    $lname = '';
    $fname = '';
    $nom = $prenom = $email = $tel = '';
    
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

    <title>Paramètres du compte - Mechanic2U</title>
    <link rel="stylesheet" href="../../style/dashboard.css">
    <link rel="stylesheet" href="../../style/user_settings.css">

</head>

<body>

    <?php
    include_once 'sidebar.php';
    ?>

    <section class="home-section">
        <div class="header">
            <div class="text">Modifier les données du compte</div>
        </div>
        <div class="user_settings">
            <div class="content">
                <h1 class="user_settings-title">Informations sur le compte</h1>


                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="row">
                        <div class="form-group">
                            <span>Nom</span>
                            <input type="text" name="nom" value="<?php echo $nom; ?>"
                                placeholder="Nom" class="box">
                        </div>

                        <div class=" form-group">
                            <span>Prénom</span>
                            <input type="text" name="prenom" value="<?php echo $prenom; ?>"
                                placeholder="Prénom" class="box">


                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <span><i class="fa-solid fa-envelope"></i> Adresse e-mail</span>
                            <input type="text" name="email" value="<?php echo $email; ?>"
                                placeholder="Ex: nom@domaine.com" class="box">
                        </div>
                        <div class="form-group">
                            <span><i class="fa-solid fa-phone"></i> Numéro de téléphone</span>
                            <input type="text" name="numero" value="<?php echo $tel; ?>"
                                maxlength="10" placeholder="(+213) 0y xx xx xx xx" maxlenght="10" class="box">
                        </div>
                    </div>
                    <div class="form-footer" align="center">
                        <input type="submit" name="edit" class="sets-btn" value="Sauvegarder les modifications">
                    </div>
                </form>
                <?php
                if (isset($_POST['edit'])) {

                    $new_last_name = $_POST['nom'];
                    $new_first_name = $_POST['prenom'];
                    $new_email = $_POST['email'];
                    $new_number = $_POST['numero'];

                    $_SESSION["last_name"] = "$new_last_name";
                    $_SESSION["first_name"] = "$new_first_name";

                    $query = "UPDATE utilisateurs SET nom_utilisateur = '$new_last_name',
                      prenom_utilisateur = '$new_first_name', email_utilisateur = '$new_email', tel_utilisateur = '$new_number'
                      WHERE id_utilisateur = '$id'";

                    $result = mysqli_query($database, $query) or die(mysqli_error($database));

                    ?>
                    <script type="text/javascript">
                        alert("Mise à jour réussie.");
                        window.location = "user_settings.php";
                    </script>
                    <?php
                }
                ?>

            </div>
        </div>

    </section>

    <script src="../../script/dashboard.js"></script>

</body>

</html>