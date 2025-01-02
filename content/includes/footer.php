<?php
$isHome = is_dir("content");
?>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo $isHome ? './style/footer.css' : '../style/footer.css'; ?>">
    <link rel="stylesheet" href="<?php echo $isHome ? './style/media.css' : '../style/media.css'; ?>">
</head>

<!-- FOOTER -->
<section class="footer">
    <div class="box-container">
        <div class="box">
            <h3>Mechanic<span>2U</span></h3>
            <a href="<?php echo $isHome ? './content/about.php' : 'about.php'; ?>"> 
                <i class="fas fa-angle-right"></i> À propos de nous
            </a>
            <a href="<?php echo $isHome ? './content/services.php' : 'services.php'; ?>"> 
                <i class="fas fa-angle-right"></i> Nos services
            </a>
            <a href="<?php echo $isHome ? './content/faq.php' : 'faq.php'; ?>"> 
                <i class="fas fa-angle-right"></i> FAQ
            </a>

        </div>
        <div class="box">
            <h3>Liens rapide</h3>
            <a href="<?php echo $isHome ? './content/quote.php' : 'sos.php'; ?>"> 
                <i class="fas fa-angle-right"></i> Réparation d'urgence 
            </a>
            <a href="<?php echo $isHome ? './content/booking.php' : 'booking.php'; ?>"> 
                <i class="fas fa-angle-right"></i> Réserver un service
            </a>
            <a href="<?php echo $isHome ? './content/join_us.php' : 'join_us.php'; ?>"> 
                <i class="fas fa-angle-right"></i> Rejoindre notre équipe
            </a>
            
        </div>
        <div class="box">
            <h3>Contact Info</h3>
            <a href="#"> <i class="fas fa-phone"></i> (+213) 026 10 60 99 </a>
            <a href="mailto:support@company.com"><i class="fas fa-envelope"></i> contact@mechanic2u.dz</a>
            <a href="#"><i class="fa-sharp fa-solid fa-location-dot"></i> Tizi-Ouzou, Algérie</a>
        </div>
        <div class="box">
            <h3>Suivez-nous sur</h3>
            <a href="www.facebook.com"><i class="fab fa-facebook-f"></i> Facebook</a>
            <a href="www.twitter.com"><i class="fab fa-twitter"></i> Twitter</a>
            <a href="www.instagram.com"><i class="fab fa-instagram"></i> Instagram</a>
            <a href="www.linkedin.com"><i class="fab fa-linkedin"></i> Linkedin</a>
        </div>

    </div>
    <div class="copyright">
        Copyright &copy; 2023 Mechanic2U. Tout les droits sont réservés.
    </div>
</section>