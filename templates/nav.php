<?php
session_start();
$url_base = "http://localhost/uni/dashboard";
if (!isset($_SESSION['usuario'])) {
    header("Location: $url_base/login");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo; ?></title>    
    <link rel="stylesheet" href="<?php echo $url_base; ?>/css/nav.css">
    <link rel="stylesheet" href="<?php echo $url_base; ?>/css/secciones.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer src="<?php echo $url_base; ?>/js/script.js"></script>
    <link rel="icon" href="<?php echo $url_base; ?>/img/icon.svg">
</head>
<body>
    <nav class="sidebar">        
        <img class="logo" src="<?php echo $url_base; ?>/img/logo.svg" alt="">
        <i class="fa-solid fa-bars" id="btnMenu"></i>        
        <ul class="item__container">
            <li class="item">
                <a class="item__link" href="<?php echo $url_base; ?>">
                    <i class="fa-solid fa-house"></i>
                    <span class="item__name">Inicio</span>
                </a>
                <!-- <span class="item__tooltip">Inicio</span> -->
            </li>
            <li class="item">
                <a class="item__link" href="<?php echo $url_base; ?>/citas">
                    <i class="fa-regular fa-calendar-days"></i>
                    <span class="item__name">Citas</span>
                </a>
                <!-- <span class="item__tooltip">Citas</span> -->
            </li>
            <li class="item">
                <a class="item__link" href="<?php echo $url_base; ?>/medicos">
                    <i class="fa-solid fa-stethoscope"></i>
                    <span class="item__name">Médicos</span>
                </a>
                <!-- <span class="item__tooltip">Médicos</span> -->
            </li>
            <li class="item">
                <a class="item__link" href="<?php echo $url_base; ?>/especialidades">
                    <i class="fa-solid fa-suitcase-medical"></i>
                    <span class="item__name">Especialidades</span>
                </a>
                <!-- <span class="item__tooltip">Especialidades</span> -->
            </li>
            <li class="item">
                <a class="item__link" href="<?php echo $url_base; ?>/pacientes">
                    <i class="fa-solid fa-person"></i>
                    <span class="item__name">Pacientes</span>
                </a>
                <!-- <span class="item__tooltip">Pacientes</span> -->
            </li>
        </ul>
        <div class="profile__container">
            <div class="profile">
                <div class="profile__wrapper">
                    <img src="<?php echo $url_base; ?>/img/profile.avif" alt="">
                    <div class="profile__info">
                        <p class="profile__name">Diego Urday</p>
                        <p class="profile__job">Administrador</p>
                    </div>
                </div>
                <a href="<?php echo $url_base; ?>/logout.php">
                    <i class="fa-solid fa-arrow-right-from-bracket" id="btnLogout"></i>                    
                </a>                
            </div>            
        </div>
    </nav>