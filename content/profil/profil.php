<?php
require '../includes/config.php';

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
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profil - Mechanic2U</title>
    <link rel="stylesheet" href="../../style/dashboard.css">
    <link rel="stylesheet" href="../../style/listes.css">

</head>

<body>

    <?php
    include_once 'sidebar.php';
    ?>

    <section class="home-section">
        <div class="header">
            <div class="text">Page de profil</div>
        </div>

        <div class="category">

            <h1 class="heading">tableau de bord</h1>

            <div class="swiper category-slider">

                <div class="swiper-wrapper">

                    <a href="#" class="swiper-slide slide">
                        <img src="../../images/dashboard/on_hold.svg" alt="">
                        <h3>Réservations<br> en attente</h3>
                        <?php
                        $query = "SELECT id_reservation from reservation WHERE status='En Attente' ORDER BY id_reservation";
                        $query_run = mysqli_query($database, $query);

                        $row = mysqli_num_rows($query_run);
                        echo '<h3>' . $row . '</h3>';
                        ?>
                    </a>

                    <a href="#" class="swiper-slide slide">
                        <img src="../../images/dashboard/confirmed.svg" alt="">
                        <h3>Réservations<br> effectuées</h3>
                        <?php
                        $query = "SELECT id_reservation from reservation WHERE status='Confirmée' ORDER BY id_reservation";
                        $query_run = mysqli_query($database, $query);

                        $row = mysqli_num_rows($query_run);
                        echo '<h3>' . $row . '</h3>';
                        ?>
                    </a>

                    <a href="#" class="swiper-slide slide">
                        <img src="../../images/dashboard/canceled.svg" alt="">
                        <h3>Réservations<br> annulées</h3>
                        <?php
                        $query = "SELECT id_reservation from reservation WHERE status='Annulée' ORDER BY id_reservation";
                        $query_run = mysqli_query($database, $query);

                        $row = mysqli_num_rows($query_run);
                        echo '<h3>' . $row . '</h3>';
                        ?>
                    </a>

                    <a href="#" class="swiper-slide slide">
                        <img src="../../images/dashboard/registery_date.svg" alt="">
                        <h3>Date<br> d'inscription</h3>
                        <?php
                        $query = "SELECT date_creation from utilisateurs ORDER BY id_utilisateur";
                        $query_run = mysqli_query($database, $query);

                        $row = mysqli_fetch_array($query_run);
                        echo '<h3>' . $row['date_creation'] . '</h3>';
                        ?>
                    </a>

                </div>
            </div>
            <div class="swiper-pagination"></div>

        </div>

        </div>
    </section>

    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script src="../../script/dashboard.js"></script>
    <script>

        var swiper = new Swiper(".home-slider", {
            loop: true,
            spaceBetween: 20,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });

        var swiper = new Swiper(".category-slider", {
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            slidesPerView: 1,
            spaceBetween: 20,
            autoHeight: true,
            grabCursor: true,
            loop: true,
            keyboard: {
                enabled: true,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },

            breakpoints: {
                // when window width is >= 767px 
                767: {
                    slidesPerView: 1,
                },
            },
        });


    </script>

</body>

</html>