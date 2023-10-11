<?php
include("../db.php");

if ($_POST) {    
    $apPaterno = (isset($_POST["apPaterno"])) ? $_POST["apPaterno"] : null;
    $apMaterno = (isset($_POST["apMaterno"])) ? $_POST["apMaterno"] : null;
    $nombres = (isset($_POST["nombres"])) ? $_POST["nombres"] : null;
    $selectTipoDoc = (isset($_POST["selectTipoDoc"])) ? $_POST["selectTipoDoc"] : null;
    $numDoc = (isset($_POST["numDoc"])) ? $_POST["numDoc"] : null;
    $direccion = (isset($_POST["direccion"])) ? $_POST["direccion"] : null;
    $telefono = (isset($_POST["telefono"])) ? $_POST["telefono"] : null;
    $distrito = (isset($_POST["distrito"])) ? $_POST["distrito"] : null;    

    $stmt = $conn->prepare("INSERT INTO persona (idDistrito,apPaterno,apMaterno,nombres,tipoDocumento,numDocumento,direccion,telefono)
    VALUES (:idDistrito,:apPaterno,:apMaterno,:nombres,:selectTipoDoc,:numDoc,:direccion,:telefono);");

    $stmt->bindParam(":idDistrito",$distrito);
    $stmt->bindParam(":apPaterno",$apPaterno);
    $stmt->bindParam(":apMaterno",$apMaterno);
    $stmt->bindParam(":nombres",$nombres);
    $stmt->bindParam(":selectTipoDoc",$selectTipoDoc);
    $stmt->bindParam(":numDoc",$numDoc);
    $stmt->bindParam(":direccion",$direccion);
    $stmt->bindParam(":telefono",$telefono);
    $stmt->execute();

    $idPersona = $conn->lastInsertId();
    $stmt = $conn->prepare("INSERT INTO paciente (idPersona) VALUES (:idPersona)");
    $stmt->bindParam(":idPersona",$idPersona);
    $stmt->execute();

    header("Location: ../pacientes");
}

$stmt = $conn->prepare("SELECT * FROM departamento WHERE estado=1");
$stmt->execute();
$datos_departamento = $stmt->fetchAll(PDO::FETCH_ASSOC);

$titulo = "Nuevo Paciente | Policlínico Señor de Luren";
include("../templates/nav.php");
?>

<div class="container">
    <header class="header">
        <h2 class="header__titulo">Nuevo Paciente</h2>            
    </header>

    <main class="main">
        <div class="main__table">
            <form class="main__form" method="post">                
                <div class="input__wrapper">
                    <label for="apPaterno">Apellido Paterno:</label>
                    <input class="main__input" type="text" name="apPaterno" id="apPaterno" placeholder="Apellido Paterno" maxlength="30" required>
                </div>
                <div class="input__wrapper">
                    <label for="apMaterno">Apellido Materno:</label>
                    <input class="main__input" type="text" name="apMaterno" id="apMaterno" placeholder="Apellido Materno" maxlength="30" required>
                </div>
                <div class="input__wrapper">
                    <label for="nombres">Nombres:</label>
                    <input class="main__input" type="text" name="nombres" id="nombres" placeholder="Nombres" maxlength="30" required>
                </div>
                <br>
                <div class="input__wrapper">
                    <label for="selectTipoDoc">Tipo Documento:</label>
                    <select class="main__select" name="selectTipoDoc" id="selectTipoDoc" required>
                        <option value="" disabled selected>Seleccionar tipo de documento</option>
                        <option value="DNI">DNI</option>
                        <option value="Carnet">Carnet de Extranjeria</option>                        
                    </select>
                </div>
                <div class="input__wrapper">
                    <label for="numDoc">Número de Documento:</label>
                    <input class="main__input" type="number" name="numDoc" id="numDoc" placeholder="Número de Documento" min="1" max="99999999" required>
                </div>
                <div class="input__wrapper">
                    <label for="direccion">Dirección:</label>
                    <input class="main__input" type="text" name="direccion" id="direccion" placeholder="Dirección" maxlength="50" required>
                </div>
                <div class="input__wrapper">
                    <label for="telefono">Teléfono:</label>
                    <input class="main__input" type="number" name="telefono" id="telefono" placeholder="Teléfono" min="1" max="999999999" required>
                </div>
                <div class="input__wrapper">
                    <label for="departamento">Departamento:</label>
                    <select class="main__select" name="departamento" id="departamento" required>
                        <option value="" disabled selected>Seleccionar departamento</option>
                        <?php foreach ($datos_departamento as $i) { ?>
                            <option value="<?php echo $i['idDepartamento']; ?>"><?php echo $i['nomDepartamento']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="input__wrapper">
                    <label for="provincia">Provincia:</label>
                    <select class="main__select" name="provincia" id="provincia" required>
                        <option value="" disabled selected>Selecciona departamento primero</option>                    
                    </select>
                </div>
                <div class="input__wrapper">
                    <label for="distrito">Distrito:</label>
                    <select class="main__select" name="distrito" id="distrito" required>
                        <option value="" disabled selected>Selecciona provincia primero</option>                        
                    </select>
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

<script>
    const selectDepartamento = document.getElementById('departamento');
    const selectProvincia = document.getElementById('provincia');
    const selectDistrito = document.getElementById('distrito');

    selectDepartamento.addEventListener('change', () => {
        var idDepartamento = selectDepartamento.value;
        console.log(idDepartamento);
        fetch("selectData.php", {
            method: "POST",
            body: "idDepartamento="+idDepartamento,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        })
        .then(res => res.text())
        .then((data) => {
            selectProvincia.innerHTML = data;
            selectDistrito.innerHTML = '<option value="" disabled selected>Selecciona provincia primero</option>';
        })
    })

    selectProvincia.addEventListener('change', () => {
        var idProvincia = selectProvincia.value;
        console.log(idProvincia);
        fetch("selectData.php", {
            method: "POST",
            body: "idProvincia="+idProvincia,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        })
        .then(res => res.text())
        .then((data) => {
            selectDistrito.innerHTML = data
        })
    })
</script>