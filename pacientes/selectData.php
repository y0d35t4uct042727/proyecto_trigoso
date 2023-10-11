<?php
include("../db.php");

if (isset($_POST["idDepartamento"])) {    
    $idDepartamento = $_POST["idDepartamento"];
    $stmt = $conn->prepare("SELECT * FROM provincia WHERE idDepartamento=:idDepartamento AND estado = 1");
    $stmt->bindParam(":idDepartamento",$idDepartamento);
    $stmt->execute();
    $datos_provincia = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
        <option value="" disabled selected>Seleccionar provincia</option>
    <?php
    foreach ($datos_provincia as $i) { ?>
        <option value="<?php echo $i["idProvincia"]; ?>"><?php echo $i["nomProvincia"]; ?></option>    
    <?php }
} elseif (isset($_POST["idProvincia"])) {
    $idProvincia = $_POST["idProvincia"];
    $stmt = $conn->prepare("SELECT * FROM distrito WHERE idProvincia=:idProvincia AND estado = 1");
    $stmt->bindParam(":idProvincia",$idProvincia);
    $stmt->execute();
    $datos_distrito = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
        <option value="" disabled selected>Seleccionar provincia</option>
    <?php
    foreach ($datos_distrito as $i) { ?>
        <option value="<?php echo $i["idDistrito"]; ?>"><?php echo $i["nomDistrito"]; ?></option>
    <?php }
}

?>