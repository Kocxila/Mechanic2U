<?php
    include'../../content/includes/config.php';
?>

<?php
$id_reparation = $_GET['confirm_reparation'];
if(isset($_POST['confirm_reparation'])){

};


$confirm = "UPDATE reparation_durgence SET status='Confirmée' WHERE id_reparation = '$id_reparation'" or die('query failed');
$sql = mysqli_query($database, $confirm);

if($sql){
    header('location: ../new_reparation.php');
}

?>