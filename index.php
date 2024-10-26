<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/index.css">
    <link rel="stylesheet" href="./style/media.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>
</head>

<body id="acceuil">

    <?php
    include_once './content/includes/header.php';
    ?>

    <!-- Section Home-->
    <section class="home">
        <div class="swiper home-slider">
            <div class="swiper-wrapper">

                <div class="swiper-slide slide" style="background:url(images/slides/urgent_repair.svg) no-repeat">
                    <div class="content">
                        <h3>Mechanic2U vient chez vous !</h3>

                        <a href="./content/sos.php" class="btn">Obtenir de l'aide</a>
                    </div>
                </div>

                <div class="swiper-slide slide" style="background:url(images/slides/reservation.svg) no-repeat">
                    <div class="content">
                        <h3>Prenez <br>rendez-vous<br>dès aujourd'hui!<br></h3>
                        <a href="./content/booking.php" class="btn">Réserver un service</a>
                    </div>
                </div>

                <div class="swiper-slide slide" style="background:url(images/slides/join_team.svg) no-repeat">
                    <div class="content">
                        <h3>Rejoignez-nous dès aujourd'hui!</h3>
                        <a href="./content/join_us.php" class="btn">Nous rejoindre</a>
                    </div>
                </div>

            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

    </section>

    <!-- Section comment ça fonctionne-->
    <section class="home-how-it-works">
        <h1 class="heading-title">Comment ça fonctionne?</h1>
        <div class="box-container container">
            <div class="box">
                <img src="./images/process/step1.svg"></img>
                <h3>1. Réservez en ligne</h3>
                <p> Obtenez une réparation d'urgence, prenez rendez-vous, parlez à un spécialiste - le tout en ligne !
                </p>
            </div>

            <div class="box">
                <img src="./images/process/step2.svg"></img>
                <h3>2. Nous venons à vous</h3>
                <p> Nos mécaniciens viennent à vous avec tous les outils et pièces nécessaires à votre service.</p>
            </div>

            <div class="box">
                <img src="./images/process/step3.svg"></img>
                <h3>3. Continuez votre journée</h3>
                <p> Un coup de poing pour l'expérience de réparation la plus cool de tous les temps... et c'est tout !
                </p>
            </div>
        </div>
        <div class="load-more"><a href="./content/faq.php" class="btn">En savoir plus</a></div>

    </section>


    <!-- Section Home Booking-->
    <section class="home-booking">
        <div class="image">
            <img src="images/booking.svg">
        </div>
        <div class="content">
            <h3>Réservation</h3>
            <p>Profitez de Mechanic2U et commencez à prendre rendez-vous avec l'un de nos meilleurs prestataires de
                services automobiles dès aujourd'hui !
            </p>
            <a href="./content/booking.php" class="btn"><i class="fa-regular fa-calendar-check"></i></i></i></i>&nbsp
                Réservez maintenant</a>
        </div>
    </section>


    <!-- Section icons-container-->
    <section class="icons-container">
        <div class="icons">
            <i class="fa-solid fa-users"></i>
            <h3 class="counter"> 222 </h3>
            <p>Nombre total de visites</p>
        </div>
        <div class="icons">
            <i class="fa-solid fa-screwdriver-wrench"></i>
            <h3 class="counter"> 101 </h3>
            <p>Nombre de réparations d'urgence</p>
        </div>
        <div class="icons">
            <i class="fa-solid fa-user-gear"></i>
            <h3 class="counter"> 20 </h3>
            <p>Mécaniciens experts</p>
        </div>
        <div class="icons">
            <i class="fa-solid fa-face-smile"></i>
            <h3 class="counter"> 100 </h3>
            <p>Clients satisfaits</p>
        </div>

    </section>

    <!-- Section Service-->
    <section>
    </section>
    <section class="home-services">
        <h1 class="heading-title"> NOS SERVICES</h1>
        <box class="box-container">
            <div class="box">
                <img src=./images/repairs/battery.svg>
                <h3>Remplacement de la batterie</h3>
            </div>
            <div class="box">
                <img src="./images/repairs/spark-plug.svg" alt="">
                <h3>Remplacement de bougies d'allumage</h3>
            </div>
            <div class="box">
                <img src="./images/repairs/oil.svg" alt="">
                <h3>Changement d'huile synthétique</h3>
            </div>
            <div class="box">
                <img src="./images/repairs/engine.svg" alt="">
                <h3>Mise au point du moteur</h3>
            </div>
            <div class="box">
                <img src="./images/repairs/tire.svg" alt="">
                <h3>Réparation de crevaison</h3>
            </div>
            <div class="box">
                <img src="./images/repairs/gearshift.svg" alt="">
                <h3>Reconditionnement de boîtes de vitesses</h3>
            </div>
        </box>
        <div class="load-more"><a href="./content/services.php" class="btn">Voir toutes les réparations</a></div>
    </section>


    <!-- Section À propos-->
    <section class="home-about">
        <div class="image">
            <img src="images/about.svg">
        </div>
        <div class="content">
            <h3>À propos de nous</h3>
            <p>Mechanic2U fait venir le garage chez vous sans que vous ayez à vous rendre à un atelier. Si vous avez
                besoin d'un entretien ou d'une réparation, nous viendront chez vous ou à votre lieu de travail.</p>
            <a href="./content/about.php" class="btn">En savoir plus</a>
        </div>
    </section>

    <div id="return-to-top">
        <i class="fas fa-arrow-up-long"></i>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="./script/index.js"></script>
    <script src="./script/button.js"></script>


    <?php
    include_once './content/includes/footer.php';
    ?>

</body>

</html>