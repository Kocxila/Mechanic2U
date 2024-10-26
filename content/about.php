<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>About us</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/media.css">
    <link rel="stylesheet" href="../style/about.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
</head>

<body id="apropos">

    <?php
    include_once './includes/header.php';
    ?>

    <div class="heading" style="background:url(../images/background.jpg) no-repeat">
        <h1>À propos</h1>
    </div>

    <!-- About section starts-->
    <section class="about">
        <div class="image">
            <img src="../images/phone.png" alt="">
        </div>
        <div class="content">
            <h3>Qui sommes-nous?</h3>
            <p> 
                Chez <b>Mechanic2U</b>, nous comprenons que les problèmes
                de voiture peuvent être stressants et gênants.
                C'est pourquoi nous avons mis au point un service de mécanique
                mobile qui rapproche l'atelier de vous.
                Notre équipe de mécaniciens experts s'engage à fournir des services
                automobiles rapides, fiables dans
                le confort et la commodité de votre domicile ou de votre bureau.
                Grace a notre site web vous pouvez facilement prendre <b>rendez-vous</b>,
                ou vous soyez!
            </p>
            <p>
                Des vidanges d'huile aux reconstructions de moteur, nous avons les connaissances
                et les outils pour faire le travail correctement. Et grâce à nos <b>services
                    d'urgence disponibles 24 heures sur 24 et 7 jours sur 7 </b>, vous pouvez être
                tranquille en sachant que nous sommes toujours là pour vous aider en un simple clic.
            </p>
            <p>
                Grace à <b>la geolocalisation</b>, nos mecanicien vous trouvent rapidement et
                sans difficulte, alors fini le stress! Contactez-nous dès aujourd'hui pour
                profiter de la commodité et de la tranquillité d'esprit de nos services de mécanique mobile.
            </p>
            <p>
                <b>Et pour les mecanicien,la communaute</b> de <b>mechanic2U</b> c'est aussi:<br>

            <ul class="list">
                <li> Une facon simple de <b>bâtir un revenu supplémentaire</b> sur vos compétences automobiles.</li>
                <li>Un moyen de <b>valoriser votre savoir-faire</b>.</li>
                <li>La possibilité de se créer <b>un réseau de clients</b> pour son atelier.</li>
            </ul>

            </p>
            <div class="icons-container">
                <div class="icons">
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                    <span> Meilleur service</span>
                </div>
                <div class="icons">
                    <i class="fas fa-hand-holding-usd"></i>
                    <span> Prix abordable</span>
                </div>
                <div class="icons">
                    <i class="fas fa-headset"></i>
                    <span> Service de support 24h/24 et 7j/7</span>
                </div>

            </div>
        </div>
        </div>
    </section>

    <!-- Section reviews-->
    <section class="reviews">
        <h3>CE QUE NOS CLIENTS PARLENT DE NOUS</h3>

        <div class="swiper reviews-slider">

            <div class="swiper-wrapper">

                <div class="swiper-slide slide">
                    <h3>Utilisateur1</h3>
                    <img src="../images/user.png" alt="">
                    <span>Client</span>
                    <p>"J'ai eu une crevaison sur le chemin du travail et j'étais coincé sur
                        le bord de la route. J'ai lancé le site web Mechanic2U et j'ai pu demander
                        de l'aide immédiatement. Le mécanicien est arrivé rapidement et a changé
                        mon pneu en un rien de temps. Cette application m'a sauvé la mise !"
                    </p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <div class="swiper-slide slide">
                    <h3>Utilisateur2</h3>
                    <img src="../images/user.png" alt="">
                    <span>Client</span>
                    <p>"J'étais hésitant à utiliser un site de mécanique mobile, mais après avoir
                        essayé Mechanic2U, je suis convaincu ! La commodité d'avoir un mécanicien qui
                        vient à mon domicile était imbattable, et le mécanicien était professionnel
                        et efficace. Je le recommande vivement !"
                    </p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
                <div class="swiper-slide slide">
                    <h3>Utilisateur3</h3>
                    <img src="../images/user.png" alt="">
                    <span>Client</span>
                    <p>"J'ai trouvé le site facile à utiliser et j'ai pu prendre rendez-vous avec
                        un mécanicien en quelques minutes seulement. Le mécanicien est arrivé à l'heure
                        et a pu diagnostiquer et résoudre le problème rapidement. J'utiliserai
                        certainement ce site à nouveau !"
                    </p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
                <div class="swiper-slide slide">
                    <h3>Utilisateur4</h3>
                    <img src="../images/user.png" alt="">
                    <span>Client</span>
                    <p>"J'utilise Mechanic2U depuis quelques mois maintenant, et je ne pourrais pas
                        être plus satisfait du service. Le site facilite la prise de rendez-vous, et les
                        mécaniciens sont toujours compétents et courtois. Je recommande vivement ce site
                        à tous ceux qui ont besoin de faire réparer leur voiture !"
                    </p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="swiper-slide slide">
                    <h3>Utilisateur5</h3>
                    <img src="../images/user.png" alt="">
                    <span>Client</span>
                    <p>"Ce site change la donne ! Avant, je redoutais d'emmener ma voiture au garage
                        et d'attendre des heures. Avec Mechanic2U, je peux faire venir un mécanicien chez
                        moi et les réparations sont effectuées rapidement et efficacement. C'est comme si
                        j'avais un mécanicien personnel sur appel !"
                    </p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
                <div class="swiper-slide slide">
                    <h3>Utilisateur6</h3>
                    <img src="../images/user.png" alt="">
                    <span>Client</span>
                    <p>"Mechanic2U nous sauve la vie ! Le site est facile à utiliser et les mécaniciens
                        sont fiables et compétents. J'ai utilisé cette application plusieurs fois maintenant,
                        et je suis toujours satisfait du service."
                    </p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>


    </section>

    <?php
    include_once './includes/footer.php';
    ?>

    <div id="return-to-top">
        <i class="fas fa-arrow-up-long"></i>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="../script/about.js"></script>
    <script src="../script/button.js"></script>

</body>

</html>