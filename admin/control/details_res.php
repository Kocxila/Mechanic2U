<?php
    include'../../content/includes/config.php';
?>

<?php
$id_reservation = $_GET['details'];
if(isset($_POST['details'])){

};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Espace Admin - Mechanic2U</title>
   <link rel="stylesheet" href="../../style/listes.css">
   <link rel="stylesheet" href="../../style/dashboard.css">
   <link rel="stylesheet" href="../../style/details.css">
   <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />

</head>
<body>


<div class="container">

   <?php
      
      $select = mysqli_query($database, "SELECT * FROM reservation WHERE id_reservation = '$id_reservation'");
      while($row = mysqli_fetch_assoc($select)){

   ?>
   
   <table>
        <th colspan="2">
            <h3 class="title">Informations sur la réservation:</h3>
        </th><br><br>
        <tr colspan="2" class="box" align="center"> 
            <td><b>Id réservation :</b> &nbsp;&nbsp;&nbsp; <?php echo $row['id_reservation']; ?></td>
        </tr>
        <tr colspan="2" class="box" align="center"> 
            <td><b>Status de la réservation :</b> &nbsp;&nbsp;&nbsp; <?php echo $row['status']; ?></td>
        </tr>
        <tr colspan="2" class="box"> 
            <td><b>Client :</b></td>
        </tr>
        <tr class="box" colspan="2" align="center">
            <td><?php echo $row['nom']; ?> &nbsp; <?php echo $row['prenom']; ?></td>
        </tr>
        <tr colspan="2" class="box"> 
            <td><b>Email :</b></td>
        </tr>
        <tr class="box" colspan="2" align="center">
            <td><?php echo $row['email']; ?></td>
        </tr>
        <tr colspan="2" class="box"> 
            <td><b>Numéro de téléphone :</b></td>
            </tr>
        <tr class="box" colspan="2" align="center">
            <td><?php echo $row['numero']; ?></td>
        </tr>
        <tr colspan="2" class="box"> 
            <td><b>Adresse :</b></td>
            </tr>
        <tr class="box" colspan="2" align="center">
            <td><?php echo $row['adresse']; ?></td>
        </tr>
        <tr colspan="2" class="box"> 
            <td><b>Service :</b></td>
            </tr>
        <tr class="box" colspan="2" align="center">
            <td><?php echo $row['service']; ?></td>
        </tr>
        <tr colspan="2" class="box"> 
            <td><b>Marque de voiture :</b></td>
            </tr>
        <tr class="box" colspan="2" align="center">
            <td><?php echo $row['marque']; ?></td>
        </tr>
        <tr colspan="2" class="box"> 
            <td><b>Modèle du véhicule :</b></td>
            </tr>
        <tr class="box" colspan="2" align="center">
            <td><?php echo $row['modele']; ?></td>
        </tr>
        <tr colspan="2" class="box"> 
            <td><b>Année de production du véhicule :</b></td>
            </tr>
        <tr class="box" colspan="2" align="center">
            <td><?php echo $row['annee_prod']; ?></td>
        </tr>
        <tr colspan="2" class="box"> 
            <td><b>Date de réservation :</b></td>
            </tr>
        <tr class="box" colspan="2" align="center">
            <td><?php echo $row['date_reservation']; ?><td>
        </tr>
        <tr colspan="2" class="box"> 
            <td><b>Commentaire :</b></td>
        </tr>
        <tr class="box" colspan="2" align="center">
            <td><?php echo $row['commentaire']; ?>
                <a href="../new_reservation.php" class="close"> Fermer</a>
            <td>
        </tr>
        
       
   </table>
   

</div>

<?php }; ?>

</body>
</html>