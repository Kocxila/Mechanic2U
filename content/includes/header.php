<?php
// Initialize the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) {
    $logged_in = true;
    $lname = ucfirst(strtolower($_SESSION["last_name"]));
    $fname = ucfirst(strtolower($_SESSION["first_name"]));
} else {
    $logged_in = false;
    $lname = '';
    $fname = '';
}

$isHome = is_dir("content");
?>

<head>
    <link rel="stylesheet" href="<?php echo $isHome ? './style/header.css' : '../style/header.css'; ?>">
    <link rel="stylesheet" href="<?php echo $isHome ? './style/media.css' : '../style/media.css'; ?>">
</head>

<header class="header">
    <section class="flex">
        <a href="<?php echo $isHome ? 'index.php' : '../index.php'; ?>" class="logo">
            <i class="fa-solid fa-screwdriver-wrench"></i> Mechanic<span>2U</span>
        </a>
        <nav class="navbar">
            <a href="<?php echo $isHome ? 'index.php' : '../index.php'; ?>" data-active="acceuil">Acceuil</a>
            <a href="<?php echo $isHome ? './content/services.php' : 'services.php'; ?>"
                data-active="services">Services</a>
            <a href="<?php echo $isHome ? './content/sos.php' : 'sos.php'; ?>" data-active="sos">SOS!</a>
            <a href="<?php echo $isHome ? './content/booking.php' : 'booking.php'; ?>"
                data-active="reservation">Réservation</a>

            <a href="<?php echo $isHome ? './content/about.php' : 'about.php'; ?>" data-active="apropos">À propos</a>

        </nav>
        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
        </div>
        <div class="profile">
            <p>
                <?php
                echo $lname, '&nbsp;', $fname; ?>
            </p>
            <div class="flex-btn">
                <a class="option-btn"
                    href="<?php echo $logged_in ? ($isHome ? './content/profil/profil.php' : './profil/profil.php') : ($isHome ? './content/authentification/register.php' : './authentification/register.php'); ?>"><?php echo $logged_in ? "Profil   " : "Inscription"; ?></a>
                <a class="option-btn"
                    href="<?php echo $logged_in ? ($isHome ? './content/authentification/logout.php' : './authentification/logout.php') : ($isHome ? './content/authentification/login.php' : './authentification/login.php'); ?>"><?php echo $logged_in ? "Deconnexion" : "Connexion" ?></a>
            </div>
        </div>
    </section>
</header>


<script src="<?php echo $isHome ? './script/header.js' : '../script/header.js'; ?>"></script>