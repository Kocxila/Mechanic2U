
<?php
// Initialize the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) {
    $logged_in = true;
    $lname = ucfirst(strtolower($_SESSION["last_name"]));
    $fname = ucfirst(strtolower($_SESSION["first_name"]));
    $email_utilisateur = $_SESSION["email"];
} else {
    $logged_in = false;
    $lname = '';
    $fname = '';
}
?>

<div class="sidebar">
    <div class="logo-details">
        <div class="logo_name">
            <i class="fa-solid fa-screwdriver-wrench"></i> Mechanic<span>2U</span></div>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
      <li>
        <a href="admin_panel.php">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Tableau de bord</span>
        </a>
         <span class="tooltip">Tableau de bord</span>
      </li>
     <li>
       <a href="preinscription.php">
        <i class="fas fa-user-plus"></i>
         <span class="links_name">Pré-inscriptions</span>
       </a>
       <span class="tooltip">Pré-inscriptions</span>
     </li>
      <li>
       <a href="reservation_list.php">
            <i class="fas fa-calendar-days"></i>
            <span class="links_name">Réservations</span>
       </a>
       <span class="tooltip">Réservations</span>
     </li>
     <li>
       <a href="reparation_list.php">
            <i class='bx bxs-car-mechanic'></i>
            <span class="links_name">Réparations d'urgence</span>
       </a>
       <span class="tooltip">Réparations d'urgence</span>
     </li>
     <li>
       <a href="mechanics.php">
        <i class="fa-solid fa-users-gear"></i>
         <span class="links_name">Mécaniciens</span>
       </a>
       <span class="tooltip">Mécaniciens</span>
     </li>
     <li>
       <a href="users.php">
            <i class="fa-solid fa-users"></i>
            <span class="links_name">Utilisateurs</span>
       </a>
       <span class="tooltip">Utilisateurs</span>
     </li>
     <li class="profile">
         <div class="profile-details">
           <div class="name_job">
             <div class="name">
                
                <?php
                    echo $lname, '&nbsp;', $fname;
                ?>

             </div>
             <div class="job">Espace Admin</div>
           </div>
         </div>
         <div class="logout">
            <a href="../content/authentification/logout.php">
                  <i class='bx bx-log-out' id="log_out"></i>
                </a>
          </div>
     </li>
    </ul>
  </div>  
  <script src="../script/dashboard.js"></script>