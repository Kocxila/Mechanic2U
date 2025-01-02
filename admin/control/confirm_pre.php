<?php
    include'../../content/includes/config.php';
?>

<?php
$id_preinscription = $_GET['confirm_pre'];
if(isset($_POST['confirm_pre'])){

};

$select = mysqli_query($database, "SELECT email FROM preinscription where id_preinscription = '$id_preinscription'");

$row = mysqli_fetch_assoc($select);
$email = $row['email'];

$confirm = "UPDATE utilisateurs SET id_role='2' WHERE email_utilisateur = '$email'" or die('query failed');
$sql = mysqli_query($database, $confirm);

$edit = mysqli_query($database, "UPDATE preinscription SET etat='Confirmée' WHERE id_preinscription = '$id_preinscription'") or die('query failed');


if($sql && $edit){
    header('location: ../preinscription.php');
}

?>