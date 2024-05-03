<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'baglan.php';

?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Free responsive business website template</title>
    <link rel="stylesheet" href="css/components.css">
    <link rel="stylesheet" href="css/icons.css">
    <link rel="stylesheet" href="css/responsee.css">
    <link rel="stylesheet" href="owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="owl-carousel/owl.theme.css">
    <!-- CUSTOM STYLE -->      
    <link rel="stylesheet" href="css/template-style.css">
    <link href="https://fonts.googleapis.com/css?family=Barlow:100,300,400,700,800&amp;subset=latin-ext" rel="stylesheet">  
    <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>   
</head>
<body class="size-1520 primary-color-red background-dark">
    <!-- HEADER -->
    <header class="grid">
        <!-- Top Navigation -->
        <nav class="s-12 grid background-none background-primary-hightlight">
            <!-- logo -->
            <a href="index.html" class="m-12 l-3 padding-2x logo">
                <img src="img/logo.svg">
            </a>
            <div class="top-nav s-12 l-9"> 
                <ul class="top-ul right chevron">
                    <li><a href="index2.php">Anasayfa</a></li>
                    <li><a href="analiz.php">Analiz</a></li>
                    <li><a href="ayarlar.php">Ayarlar</a></li>
                    <li><a href="cikis.php">Çıkış Yap</a></li>
                </ul>
            </div>
        </nav>
    </header>
    
    <!-- MAIN -->
    <main role="main">
        <!-- TOP SECTION -->
        <section class="grid">
            <!-- Main Carousel -->
            <div class="s-12 margin-bottom carousel-fade-transition owl-carousel carousel-main carousel-nav-white carousel-hide-arrows background-dark">
                <div class="item background-image" style="background-image:url(img/carousel-01.jpg)">
                    <p class="text-padding text-strong text-white text-s-size-30 text-size-60 text-uppercase background-primary">We are Web design Heroes</p>
                    <p class="text-padding text-size-20 text-dark text-uppercase background-white">Con nonummy sem integer interdum volutpat dis eget eligendi aliquip dolorum magnam.</p>
                </div>
                <div class="item background-image" style="background-image:url(img/carousel-02.jpg)">
                    <p class="text-padding text-strong text-white text-s-size-30 text-size-60 text-uppercase background-primary">Inspired by Technologies</p>
                    <p class="text-padding text-size-20 text-dark text-uppercase background-white">Con nonummy sem integer interdum volutpat dis eget eligendi aliquip dolorum magnam.</p>
                </div>
                <div class="item background-image" style="background-image:url(img/carousel-03.jpg)">
                    <p class="text-padding text-strong text-white text-s-size-30 text-size-60 text-uppercase background-primary">CSS and HTML is our Playground</p>
                    <p class="text-padding text-size-20 text-dark text-uppercase background-white">Con nonummy sem integer interdum volutpat dis eget eligendi aliquip dolorum magnam.</p>
                </div>
            </div>  
        </section>
        
        <!-- SECTION 1 --> 
        <section class="grid margin text-center">
            <a href="bil.php" class="s-12 m-6 l-3 padding-2x vertical-center margin-bottom background-red">
                <i class="icon-sli-equalizer text-size-60 text-white center margin-bottom-15"></i>
                <h3 class="text-strong text-size-20 text-line-height-1 margin-bottom-30 text-uppercase">KELİMENİ BİL</h3>
            </a>
            <a href="analiz.php" class="s-12 m-6 l-3 padding-2x vertical-center margin-bottom background-blue">
                <i class="icon-sli-layers text-size-60 text-white center margin-bottom-15"></i>
                <h3 class="text-strong text-size-20 text-line-height-1 margin-bottom-30 text-uppercase">BİLGİNİ ANALİZ ET</h3>
            </a>
            
            <!-- Image-->
            <img class="m-12 l-6 l-row-2 margin-bottom" src="img/img-06.jpg">
            
            <a href="ekle.php" class="s-12 m-6 l-3 padding-2x vertical-center margin-bottom background-orange">
                <i class="icon-sli-diamond text-size-60 text-white center margin-bottom-15"></i>
                <h3 class="text-strong text-size-20 text-line-height-1 margin-bottom-30 text-uppercase">KELİMELERİ AYARLA</h3>
            </a>
            <a href="/" class="s-12 m-6 l-3 padding-2x vertical-center margin-bottom background-aqua">
                <i class="icon-sli-share text-size-60 text-white center margin-bottom-15"></i>
                <h3 class="text-strong text-size-20 text-line-height-1 margin-bottom-30 text-uppercase">HEMEN OYUNA</h3>
            </a>
        </section>
        
        <!-- Kelime Ekleme Modülü -->
        
    </main>
    
    <!-- FOOTER -->
    <footer class="grid">
        <!-- Footer - top -->
        <!-- Image-->
        
        
        <!-- Footer - bottom -->
        <div class="s-12 text-center margin-bottom">
            <p class="text-size-12">Copyright 2019, Vision Design - graphic zoo</p>
            <p class="text-size-12">All images have been purchased from Bigstock. Do not use the images in your website.</p>
            <p><a class="text-size-12 text-primary-hover" href="http://www.myresponsee.com" title="Responsee - lightweight responsive framework">Design and coding by Responsee Team</a></p>
        </div>
    </footer>                                                                    
    <script type="text/javascript" src="js/responsee.js"></script>
    <script type="text/javascript" src="owl-carousel/owl.carousel.js"></script>
    <script type="text/javascript" src="js/template-scripts.js"></script>


</body>
</html>
