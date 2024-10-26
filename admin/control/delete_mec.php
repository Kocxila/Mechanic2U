<?php
    include'../../content/includes/config.php';
?>

<?php
$id_utilisateur = $_GET['delete_mec'];
if(isset($_POST['delete_mec'])){

};

$delete = "UPDATE utilisateurs SET id_role='3' WHERE id_utilisateur = '$id_utilisateur'" or die('query failed');
$sql= mysqli_query($database, $delete);


if($sql){
    header('location: ../mechanics.php');
}

?>