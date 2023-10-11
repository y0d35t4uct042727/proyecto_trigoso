<?php
include("../db.php");

if (isset($_GET['pacienteID'])) {    
    $pacienteID = (isset($_GET['pacienteID'])) ? $_GET['pacienteID'] : null;
    $stmt = $conn->prepare("SELECT paciente.idPaciente, persona.* FROM paciente
    JOIN persona ON paciente.idPersona = persona.idPersona
    WHERE idPaciente=:id
    AND paciente.estado=1;");
    $stmt->bindParam(":id",$pacienteID);
    $stmt->execute();
    $datos_paciente = $stmt->fetch(PDO::FETCH_LAZY);    
    $i = $datos_paciente;
}

if ($_POST) {
    $idPersona = (isset($_POST['idPersona'])) ? $_POST['idPersona'] : null;
    $apPaterno = (isset($_POST["apPaterno"])) ? $_POST["apPaterno"] : null;
    $apMaterno = (isset($_POST["apMaterno"])) ? $_POST["apMaterno"] : null;
    $nombres = (isset($_POST["nombres"])) ? $_POST["nombres"] : null;
    $selectTipoDoc = (isset($_POST["selectTipoDoc"])) ? $_POST["selectTipoDoc"] : null;
    $numDoc = (isset($_POST["numDoc"])) ? $_POST["numDoc"] : null;
    $direccion = (isset($_POST["direccion"])) ? $_POST["direccion"] : null;
    $telefono = (isset($_POST["telefono"])) ? $_POST["telefono"] : null;
    $distrito = (isset($_POST["distrito"])) ? $_POST["distrito"] : null;    

    $stmt = $conn->prepare("UPDATE persona SET idDistrito=:idDistrito,apPaterno=:apPaterno,apMaterno=:apMaterno,
    nombres=:nombres,tipoDocumento=:selectTipoDoc,numDocumento=:numDoc,direccion=:direccion,telefono=:telefono
    WHERE idPersona=:idPersona");
    
    $stmt->bindParam(":idPersona",$idPersona);
    $stmt->bindParam(":idDistrito",$distrito);
    $stmt->bindParam(":apPaterno",$apPaterno);
    $stmt->bindParam(":apMaterno",$apMaterno);
    $stmt->bindParam(":nombres",$nombres);
    $stmt->bindParam(":selectTipoDoc",$selectTipoDoc);
    $stmt->bindParam(":numDoc",$numDoc);
    $stmt->bindParam(":direccion",$direccion);
    $stmt->bindParam(":telefono",$telefono);
    $stmt->execute();
    header("Location: ../pacientes");
}

/* A SER DESARROLLADO (EDICION DE DEPARTAMENTO, PROVINCIA Y DISTRITO) */
/* $stmt = $conn->prepare("SELECT * FROM departamento WHERE estado = 1");
$stmt->execute();
$datos_departamento = $stmt->fetchAll(PDO::FETCH_ASSOC); */

$titulo = "Editar Paciente | Policlínico Señor de Luren";
include("../templates/nav.php");
?>

<div class="container">
    <header class="header">
        <h2 class="header__titulo">Editar Paciente N°<?php echo $pacienteID; ?></h2>
    </header>

    <main class="main">
        <div class="main__table">
            <form class="main__form" method="post">
                <input value="<?php echo $i['idPersona']; ?>" type="hidden" name="idPersona">
                <div class="input__wrapper">
                    <label for="apPaterno">Apellido Paterno:</label>
                    <input class="main__input" value="<?php echo $i['apPaterno']; ?>" type="text" name="apPaterno" id="apPaterno" placeholder="Apellido Paterno" maxlength="30" required>
                </div>
                <div class="input__wrapper">
                    <label for="apMaterno">Apellido Materno:</label>
                    <input class="main__input" value="<?php echo $i['apMaterno']; ?>" type="text" name="apMaterno" id="apMaterno" placeholder="Apellido Materno" maxlength="30" required>
                </div>
                <div class="input__wrapper">
                    <label for="nombres">Nombres:</label>
                    <input class="main__input" value="<?php echo $i['nombres']; ?>" type="text" name="nombres" id="nombres" placeholder="Nombres" maxlength="30" required>
                </div>
                <br>
                <div class="input__wrapper">
                    <label for="selectTipoDoc">Tipo Documento:</label>
                    <select class="main__select" name="selectTipoDoc" id="selectTipoDoc" required>
                        <option value="DNI" <?php echo ($i['tipoDocumento']=='DNI') ? "selected" : null; ?>>DNI</option>
                        <option value="Carnet" <?php echo ($i['tipoDocumento']=='Carnet') ? "selected" : null; ?>>Carnet de Extranjeria</option>
                    </select>
                </div>
                <div class="input__wrapper">
                    <label for="numDoc">Número de Documento:</label>
                    <input class="main__input" value="<?php echo $i['numDocumento']; ?>" type="number" name="numDoc" id="numDoc" placeholder="Número de Documento" min="1" max="99999999" required>
                </div>
                <div class="input__wrapper">
                    <label for="direccion">Dirección:</label>
                    <input class="main__input" value="<?php echo $i['direccion']; ?>" type="text" name="direccion" id="direccion" placeholder="Dirección" maxlength="50" required>
                </div>
                <div class="input__wrapper">
                    <label for="telefono">Teléfono:</label>
                    <input class="main__input" value="<?php echo $i['telefono']; ?>" type="number" name="telefono" id="telefono" placeholder="Teléfono" min="1" max="999999999" required>
                </div>
                <br>
                <div class="button__wrapper">
                    <button class="button button--green">
                        <i class="fa-solid fa-floppy-disk"></i> Guardar
                    </button>
                    <a class="button button--red" href="../pacientes/">Cancelar</a>
                </div>
            </form>
        </div>
    </main>
</div>