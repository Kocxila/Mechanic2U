
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

    <title>Espace Mécanicien - Mechanic2U</title>
    <link rel="stylesheet" hre<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Espace Mécanicien - Mechanic2U</title>
    <link rel="stylesheet" href="../style/listes.css">
    <link rel="stylesheet" href="../style/dashboard.css">
   </head>
<body>


<?php 
    include_once 'sidebar.php'
  ?>
  
  
  <section class="home-section">
        <div class="header">
            <div class="text">Nouvelles demandes de réparations d'urgence</div>
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
                                <th width="150px">Numéro de tel</th>
                                <th>Localisation</th>
                                <th width="250px">Service</th>
                                <th>Date/Heure</th>
                                <th width="250px">Actions</th>
                            </tr>
                        </thead>
                        <?php
                          include'../content/includes/config.php';
                          $select = mysqli_query($database, "SELECT * FROM reparation_durgence WHERE status='En Attente' ORDER BY id_reparation DESC");
                        ?>

                        <?php while($row = mysqli_fetch_assoc($select)){ ?>
                        <tr>
                            <td><?php echo $row['id_reparation']; ?></td>
                            <td><?php echo $row['nom']; ?></td>
                            <td><?php echo $row['prenom']; ?></td>
                            <td><?php echo $row['numero']; ?></td>
                            <td><?php echo $row['localisation']; ?></td>
                            <td><?php echo $row['service']; ?></td>
                            <td><?php echo $row['date_reparation']; ?></td>
                            <td>
                                <a href="./control/details_rep.php?details=<?php echo $row['id_reparation']; ?>" class="btn details">&nbsp;<i class="fas fa-edit"></i>&nbsp;&nbsp;&nbsp;&nbsp;Details </a>
                                <a href="./control/confirm_reparation.php?confirm_reparation=<?php echo $row['id_reparation']; ?>" class="btn confirm"> &nbsp;<i class="fa-regular fa-circle-check"></i> &nbsp;&nbsp;&nbsp;Confirmer </a>
                                <a href="./control/delete_reparation.php?delete_reparation=<?php echo $row['id_reparation']; ?>" class="btn delete"> &nbsp;&nbsp;<i class="fa-solid fa-xmark"></i> &nbsp;&nbsp;&nbsp;Rejeter </a>
                            </td>
                        </tr>
                    <?php } ?>
                    </table>
                    <?php 
                        if($select->num_rows==0){
                            echo '<p class="empty"> Aucune réparation à afficher.</p>';
                        }
                        ?>
                </div>
            </div>
        </div>
  </section>

  

</body>
</html>
