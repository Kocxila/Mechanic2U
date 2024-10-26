<?php
    include'../../content/includes/config.php';
?>

<?php
$id_reparation = $_GET['delete_reparation'];
if(isset($_POST['delete_reparation'])){

};


$delete = "UPDATE reparation_durgence SET status='Rejetée' WHERE id_reparation = '$id_reparation'" or die('query failed');
$sql = mysqli_query($database, $delete);

if($sql){
    header('location: ../new_reparation.php');
}

?>