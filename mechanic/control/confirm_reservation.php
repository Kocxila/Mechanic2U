<?php
    include'../../content/includes/config.php';
?>

<?php
$id_reservation = $_GET['confirm_reservation'];
if(isset($_POST['confirm_reservation'])){

};


$confirm = "UPDATE reservation SET status='Confirmée' WHERE id_reservation = '$id_reservation'" or die('query failed');
$sql = mysqli_query($database, $confirm);

if($sql){
    header('location: ../new_booking.php');
}

?>