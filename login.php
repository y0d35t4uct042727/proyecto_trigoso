<?php
session_start();
$url_base = "http://localhost/uni/dashboard";
include("db.php");
if ($_POST) {
    $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : null;
    $contrasena = (isset($_POST['contrasena'])) ? $_POST['contrasena'] : null;
    // Seleccionar registros
    $stmt = $conn->prepare("SELECT *, COUNT(*) AS n_usuario FROM tbl_usuarios WHERE usuario=:usuario AND contrasena=:contrasena");    
    $stmt->bindParam(":usuario",$usuario);
    $stmt->bindParam(":contrasena",$contrasena);
    $stmt->execute();
    $lista_usuarios = $stmt->fetch(PDO::FETCH_LAZY);
    if ($lista_usuarios['n_usuario']>0) {
        $_SESSION['usuario']=$lista_usuarios['usuario'];
        $_SESSION['logueado']=true;
        header("Location: $url_base");
    } else {        
        $mensajeError = "El usuario y/o contraseña son incorrectos";      
    }
}
if (isset($_SESSION['usuario'])) {
    header("Location: $url_base");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | Policlínico Señor de Luren</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer src="js/login.js"></script>
    <link rel="icon" href="<?php echo $url_base; ?>/img/icon.svg">
</head>
<body>
    <div class="container">
        <main class="main__container">            
            <img class="logo" src="<?php echo $url_base; ?>/img/logo_login.svg" alt="">
            <div class="main__wrapper">                    
                <form class="main__form" method="post">
                    <?php if (isset($mensajeError)) { ?>                        
                        <div class="main__error">
                            <p><?php echo $mensajeError; ?></p>
                        </div>                        
                    <?php } ?>
                    <input class="main__input" type="text" name="usuario" placeholder="Usuario" required>
                    <div class="main-pass__wrapper">
                        <input class="main-pass__input" type="password" name="contrasena" placeholder="Contraseña" required>
                        <i class="fa-solid fa-eye-slash" id="eyeicon"></i>
                    </div>                        
                    <input class="main__submit" type="submit" value="Iniciar Sesión">
                </form>
            </div>            
        </main>
    </div>   
</body>
</html>