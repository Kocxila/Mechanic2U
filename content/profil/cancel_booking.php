
<?php
    include'../includes/config.php';
?>

<?php
$id_reservation = $_GET['cancel'];
if(isset($_POST['cancel'])){

};

$cancel = "UPDATE reservation SET status='Annulée' WHERE id_reservation = '$id_reservation'" or die('query failed');


$sql= mysqli_query($database, $cancel);


if($sql){
    header('location: booking_list.php');
}

?>