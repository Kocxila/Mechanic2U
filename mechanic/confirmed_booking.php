
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
    <link rel="stylesheet" href="../style/listes.css">
    <link rel="stylesheet" href="../style/dashboard.css">
   </head>
<body>


<?php 
    include_once 'sidebar.php'
  ?>
  
  <section class="home-section">
        <div class="header">
            <div class="text">Réservations confirmées</div>
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
                                <th>Adresse</th>
                                <th width="250px">Service</th>
                                <th>Date/Heure</th>
                                <th width="180px">Actions</th>
                            </tr>
                        </thead>
                        <?php
                          include'../content/includes/config.php';
                          $select = mysqli_query($database, "SELECT * FROM reservation WHERE status='Confirmée' ORDER BY id_reservation DESC");
                        ?>

                        <?php while($row = mysqli_fetch_assoc($select)){ ?>
                        <tr>
                            <td><?php echo $row['id_reservation']; ?></td>
                            <td><?php echo $row['nom']; ?></td>
                            <td><?php echo $row['prenom']; ?></td>
                            <td><?php echo $row['numero']; ?></td>
                            <td><?php echo $row['adresse']; ?></td>
                            <td><?php echo $row['service']; ?></td>
                            <td><?php echo $row['date_reservation']; ?></td>
                            <td>
                                <a href="details_resc.php?details=<?php echo $row['id_reservation']; ?>" class="btn details">&nbsp;<i class="fas fa-edit"></i>&nbsp;Details </a>
                            </td>
                        </tr>
                    <?php } ?>
                    </table>
                    <?php 
                        if($select->num_rows==0){
                            echo '<p class="empty"> Aucune réservation à afficher.</p>';
                        }
                        ?>
                </div>
            </div>
        </div>
  </section>


</body>
</html>
