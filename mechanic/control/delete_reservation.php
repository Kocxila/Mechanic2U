<?php
    include'../../content/includes/config.php';
?>

<?php
$id_reservation = $_GET['delete_reservation'];
if(isset($_POST['delete_reservation'])){

};


$delete = "UPDATE reservation SET status='Rejetée' WHERE id_reservation = '$id_reservation'" or die('query failed');
$sql = mysqli_query($database, $delete);

if($sql){
    header('location: ../new_booking.php');
}

?>