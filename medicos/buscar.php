<?php
include("../db.php");
$busqueda = file_get_contents("php://input");
$stmt = $conn->prepare("SELECT * FROM empleado
JOIN persona ON empleado.idPersona = persona.idPersona
JOIN tipo_profesion ON empleado.idEmpleado = tipo_profesion.idEmpleado
JOIN especialidad ON tipo_profesion.idEspecialidad = especialidad.idEspecialidad;
WHERE tipo_profesion.estado=1");
$stmt->execute();
if ($busqueda != "") {
    $busquedaValidada = trim($busqueda);
    $stmt = $conn->prepare("SELECT * FROM empleado
    JOIN persona ON empleado.idPersona = persona.idPersona
    JOIN tipo_profesion ON empleado.idEmpleado = tipo_profesion.idEmpleado
    JOIN especialidad ON tipo_profesion.idEspecialidad = especialidad.idEspecialidad
    WHERE apPaterno LIKE :busqueda OR apMaterno LIKE :busqueda OR nombres LIKE :busqueda
    OR numDocumento LIKE :busqueda
    AND tipo_profesion.estado=1");
    $busquedaParam = '%'.$busquedaValidada.'%';
    $stmt->bindParam(":busqueda",$busquedaParam);
    $stmt->execute();
}
$datos_medicos = $stmt->fetchAll(PDO::FETCH_ASSOC);
include("lista_medicos.php");
?>