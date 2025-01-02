<?php
    include'../../content/includes/config.php';
?>

<?php
$id_reparation = $_GET['details'];
if(isset($_POST['details'])){

};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Espace Mécanicien - Mechanic2U</title>
   <link rel="stylesheet" href="../../style/listes.css">
   <link rel="stylesheet" href="../../style/dashboard.css">
   <link rel="stylesheet" href="../../style/details.css">
   <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />

</head>
<body>


<div class="container">

   <?php
      
      $select = mysqli_query($database, "SELECT * FROM reparation_durgence WHERE id_reparation = '$id_reparation'");
      while($row = mysqli_fetch_assoc($select)){

   ?>
   
   <table>
        <th colspan="2">
            <h3 class="title">Informations sur la réparation:</h3>
        </th><br><br>
        <tr colspan="2" class="box" align="center"> 
            <td><b>Id réparation d'urgence :</b> &nbsp;&nbsp;&nbsp; <?php echo $row['id_reparation']; ?></td>
        </tr>
        <tr colspan="2" class="box" align="center"> 
            <td><b>Status de la réparation :</b> &nbsp;&nbsp;&nbsp; <?php echo $row['status']; ?></td>
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
            <td id="loc"><b>Localisation :</b></td>
            </tr>
        <tr class="box" colspan="2" align="center">
            <td>
                <div align="center" id="map"></div>
            </td>
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
            <td><b>Année de production du véhicule :</b></td>
            </tr>
        <tr class="box" colspan="2" align="center">
            <td><?php echo $row['annee_prod']; ?></td>
        </tr>
        <tr colspan="2" class="box"> 
            <td><b>Date de la réparation :</b></td>
            </tr>
        <tr class="box" colspan="2" align="center">
            <td><?php echo $row['date_reparation']; ?><td>
        </tr>
        <tr colspan="2" class="box"> 
            <td><b>Commentaire :</b></td>
        </tr>
        <tr class="box" colspan="2" align="center">
            <td><?php echo $row['commentaire']; ?>
            <a href="../new_reparation.php" class="close"> Fermer</a><td>
                
            
        </tr>
        
       
   </table>
   

</div>

<script>
    function initMap() {

        var userLocation = "<?php echo $row['localisation']; ?>";

        var coordinates = userLocation.split(","); 
        var latitude = parseFloat(coordinates[0].trim()); 
        var longitude = parseFloat(coordinates[1].trim());
        
        var map = L.map('map').setView([latitude, longitude], 14.5);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
            }).addTo(map);
            
        L.marker([latitude, longitude]).addTo(map).bindPopup(userLocation).openPopup();

        var flagIcon = L.icon({
            iconUrl: '../images/loc.png',
            iconSize: [38, 98], // size of the icon
            iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
            popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
        });
    };

    window.onload = function () {
        initMap();
    };

</script>

<?php }; ?>

</body>
</html>