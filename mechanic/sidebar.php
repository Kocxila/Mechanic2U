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


<div class="sidebar close">
  <div class="logo-details">
    <div class="logo_name">
      <i class="fa-solid fa-screwdriver-wrench"></i> Mechanic<span>2U</span>
    </div>
    <i class='bx bx-menu' id="btn"></i>
  </div>
  <ul class="nav-list">
    <li>
      <a href="dashboard.php">
        <i class='bx bx-grid-alt'></i>
        <span class="links_name">Tableau de bord</span>
      </a>
      <span class="tooltip">Tableau de bord</span>
    </li>
    <li>
      <div class="iocn-link">
        <a href="#">
          <i class="fas fa-calendar-days"></i>
          <span class="links_name">Réservations</span>
        </a>
      </div>
      <ul class="sub-menu">
        <li><a href="new_booking.php">Réservations en attentes</a></li>
        <li><a href="confirmed_booking.php">Réservations confirmées</a></li>
      </ul>
    </li>
    <li></li>
    <li>
      <div class="iocn-link">
        <a href="#">
          <i class="bx bxs-car-mechanic"></i>
          <span class="links_name">Réparations <br>d'urgence</span>
        </a>
      </div>
      <ul class="sub-menu">
        <li><a href="new_reparation.php">&nbsp;&nbsp;Réparations en attente</a></li>
        <li><a href="confirmed_reparation.php">&nbsp;&nbsp;Réparations confirmées</a></li>
      </ul>
    </li>
    <li class="profile">
      <div class="profile-details">
        <div class="name_job">
          <div class="name">
            <?php
            echo $lname, '&nbsp;', $fname;
            ?>
          </div>
          <div class="job">Espace Mécanicien</div>
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