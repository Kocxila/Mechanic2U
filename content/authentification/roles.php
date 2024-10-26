<?php
// Initialize the session
session_start();


// If the user is not logged in, redirect them to welcome page
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] === false) {
    // header("location: ../index.php");
    // exit;
}

// Include config file
include "../includes/config.php";

echo "<pre>";
print_r($GLOBALS);
echo "</pre>";


// get the user role
$user_id = $_SESSION["user_id"];
$sql = "SELECT roles.nom_role FROM utilisateurs JOIN roles ON utilisateurs.id_role = roles.id_role WHERE utilisateurs.id_utilisateur = $user_id";
$result = $database->query($sql);

// Check if the query was successful
if ($result) {
    // Get the role name from the result
    $row = $result->fetch_assoc();
    $role_name = $row["nom_role"];
    if ($role_name == "user")
        header("location: ../../index.php");
    elseif ($role_name == "mechanic")
        header("location: ../../mechanic/dashboard.php");
    elseif ($role_name == "admin")
        header("location: ../../admin/admin_panel.php");
} else {
    // Handle the case where the query failed
    header("location: ../index.php");
}
?>