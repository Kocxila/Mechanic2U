
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
                <a href="../../index.php" class="logo_name">
                    <i class="fa-solid fa-screwdriver-wrench"></i> Mechanic<span>2U</span></a>
            </div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list">
            <li>
                <a href="profil.php">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Page de profil</span>
                </a>
                <span class="tooltip">Page de profil</span>
            </li>
            <li>
                <a href="booking_list.php">
                    <i class="fas fa-calendar-days"></i>
                    <span class="links_name">Mes réservations</span>
                </a>
                <span class="tooltip">Mes réservations</span>
            </li>

            <li>
                <a href="user_settings.php">
                    <i class='bx bx-cog'></i>
                    <span class="links_name">Modifier les <br>données du compte
                    </span>
                </a>
                <span class="tooltip">Modifier les données du compte
                </span>
            </li>
            <li>
                <a href="change_password.php">
                    <i class='bx bx-key'></i>
                    <span class="links_name">Changer le mot <br>de passe</span>
                </a>
                <span class="tooltip">Changer le mot de passe</span>
            </li>
            <li class="profile">
                <div class="profile-details">
                    <div class="name_job">
                        <div class="name">

                            <?php
                            echo $lname, '&nbsp;', $fname;
                            ?>
                        </div>
                        <div class="job">Espace Client</div>
                    </div>
                </div>
                <div class="logout">
                    <a href="../authentification/logout.php">
                        <i class='bx bx-log-out' id="log_out"></i>
                    </a>
                </div>
            </li>
        </ul>
    </div>
