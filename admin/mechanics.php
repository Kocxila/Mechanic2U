

<?php
// Initialize the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) {
    $logged_in = true;
    $lname = ucfirst(strtolower($_SESSION["last_name"]));
    $fname = ucfirst(strtolower($_SESSION["first_name"]));
    $email_utilisateur = $_SESSION["email"];
} else {
    $logged_in = false;
    $lname = '';
    $fname = '';
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

    <title>Espace Admin - Mechanic2U</title>
    <link rel="stylesheet" href="../style/listes.css">
    <link rel="stylesheet" href="../style/dashboard.css">
   </head>
<body>

  <?php include_once 'sidebar.php' ?>

  <section class="home-section">
        <div class="header">
            <div class="text">Liste des mécaniciens</div>
        </div>
        <div class="main">
            <div class="container">
                <div class="display">
                    <table class="display-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th width="300">Numéro de téléphone</th>
                                <th>Adresse E-mail</th>
                                <th width="250px">Action</th>
                            </tr>
                        </thead>
                        <?php
                          include'../content/includes/config.php';
                          $select = mysqli_query($database, "SELECT * FROM utilisateurs WHERE id_role = '2'");
                        ?>

                        <?php while($row = mysqli_fetch_assoc($select)){ ?>
                        <tr>
                            <td><?php echo $row['id_utilisateur']; ?></td>
                            <td><?php echo $row['nom_utilisateur']; ?></td>
                            <td><?php echo $row['prenom_utilisateur']; ?></td>
                            <td><?php echo $row['tel_utilisateur']; ?></td>
                            <td><?php echo $row['email_utilisateur']; ?></td>
                            <td>
                                <a href="./control/delete_mec.php?delete_mec=<?php echo $row['id_utilisateur']; ?>" class="btn delete"> &nbsp;&nbsp;<i class="fa-solid fa-xmark"></i> &nbsp;&nbsp;&nbsp;Supprimer </a>
                            </td>
                        </tr>
                    <?php } ?>
                    </table>
                    <?php 
                        if($select->num_rows==0){
                            echo '<p class="empty"> Aucun mécanicien à afficher.</p>';
                        }
                    ?>
                </div>
            </div>
        </div>
  </section>                          

  

</body>
</html>
