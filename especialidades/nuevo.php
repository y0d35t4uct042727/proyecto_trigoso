<?php
include("../db.php");
if ($_POST) {    
    $especialidad = (isset($_POST["especialidad"])) ? $_POST["especialidad"] : null;
    $descripcion = (isset($_POST["descripcion"])) ? $_POST["descripcion"] : null;    
    $stmt = $conn->prepare("INSERT INTO especialidad (especialidad,descripcion)
    VALUES (:especialidad,:descripcion);");
    $stmt->bindParam(":especialidad",$especialidad);
    $stmt->bindParam(":descripcion",$descripcion);
    $stmt->execute();
    header("Location: ../especialidades");
}
$titulo = "Nueva Especialidad | Policlínico Señor de Luren";
include("../templates/nav.php");
?>

<div class="container">
    <header class="header">
        <h2 class="header__titulo">Nueva Especialidad</h2>            
    </header>
    <main class="main">
        <div class="main__table">
            <form class="main__form" method="post">                
                <div class="input__wrapper">
                    <label for="especialidad">Especialidad:</label>
                    <input class="main__input" type="text" name="especialidad" id="especialidad" placeholder="Especialidad" maxlength="30" required>
                </div>
                <div class="input__wrapper">
                    <label for="descripcion">Descripción:</label>
                    <input class="main__input" type="text" name="descripcion" id="descripcion" placeholder="Descripción" maxlength="30" required>
                </div>
                <div class="button__wrapper">
                    <button class="button button--green">
                        <i class="fa-solid fa-floppy-disk"></i> Guardar
                    </button>
                    <a class="button button--red" href="../especialidades/">Cancelar</a>
                </div>
            </form>
        </div>
    </main>
</div>