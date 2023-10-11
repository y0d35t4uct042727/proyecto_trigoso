<?php
include("../db.php");
$busqueda = file_get_contents("php://input");
$stmt = $conn->prepare("SELECT * FROM especialidad WHERE estado=1");
$stmt->execute();
if ($busqueda != "") {
    $busquedaValidada = trim($busqueda);
    $stmt = $conn->prepare("SELECT * FROM especialidad 
    WHERE especialidad LIKE :especialidad
    AND estado=1");
    $busquedaParam = '%'.$busquedaValidada.'%';
    $stmt->bindParam(":especialidad",$busquedaParam);
    $stmt->execute();
}
$datos_especialidades = $stmt->fetchAll(PDO::FETCH_ASSOC);
include("lista_especialidades.php");
?>