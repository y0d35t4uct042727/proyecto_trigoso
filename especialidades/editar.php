<?php
include("../db.php");
if (isset($_GET['especialidadID'])) {
    $especialidadID = (isset($_GET['especialidadID'])) ? $_GET['especialidadID'] : null;
    $stmt = $conn->prepare("SELECT * FROM especialidad WHERE idEspecialidad=:id AND estado=1;");
    $stmt->bindParam(":id",$especialidadID);
    $stmt->execute();
    $datos_especialidades = $stmt->fetch(PDO::FETCH_LAZY);
    $i = $datos_especialidades;
}
if ($_POST) {    
    $especialidad = (isset($_POST["especialidad"])) ? $_POST["especialidad"] : null;
    $descripcion = (isset($_POST["descripcion"])) ? $_POST["descripcion"] : null;    
    $stmt = $conn->prepare("UPDATE especialidad SET especialidad=:especialidad,descripcion=:descripcion
    WHERE idEspecialidad=:idEspecialidad");
    $stmt->bindParam(":idEspecialidad",$especialidadID);
    $stmt->bindParam(":especialidad",$especialidad);
    $stmt->bindParam(":descripcion",$descripcion);
    $stmt->execute();
    header("Location: ../especialidades");
}
$titulo = "Editar Especialidad | Policlínico Señor de Luren";
include("../templates/nav.php");
?>

<div class="container">
    <header class="header">        
        <h2 class="header__titulo">Editar Especialidad N°<?php echo $especialidadID; ?></h2>
    </header>
    <main class="main">
        <div class="main__table">
            <form class="main__form" method="post">                
                <div class="input__wrapper">
                    <label for="especialidad">Especialidad:</label>
                    <input class="main__input" value="<?php echo $i['especialidad']; ?>" type="text" name="especialidad" id="especialidad" placeholder="Especialidad" maxlength="30" required>
                </div>
                <div class="input__wrapper">
                    <label for="descripcion">Descripción:</label>
                    <input class="main__input" value="<?php echo $i['descripcion']; ?>" type="text" name="descripcion" id="descripcion" placeholder="Descripción" maxlength="30" required>
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