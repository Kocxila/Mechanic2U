<?php
    include'../../content/includes/config.php';
?>

<?php
$id_preinscription = $_GET['delete_pre'];
if(isset($_POST['delete_pre'])){

};

$delete = "UPDATE preinscription SET etat='Rejetée' WHERE id_preinscription = '$id_preinscription'" or die('query failed');
$sql= mysqli_query($database, $delete);


if($sql){
    header('location: ../preinscription.php');
}

?>