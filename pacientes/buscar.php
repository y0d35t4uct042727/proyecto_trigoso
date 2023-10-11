<?php
include("../db.php");
$busqueda = file_get_contents("php://input");
$stmt = $conn->prepare("SELECT paciente.idPaciente, persona.* FROM paciente
JOIN persona ON paciente.idPersona = persona.idPersona
WHERE paciente.estado=1");
$stmt->execute();
if ($busqueda != "") {
    $busquedaValidada = trim($busqueda);
    $stmt = $conn->prepare("SELECT paciente.idPaciente, persona.* FROM paciente
    JOIN persona ON paciente.idPersona = persona.idPersona
    WHERE apPaterno LIKE :busqueda OR apMaterno LIKE :busqueda OR nombres LIKE :busqueda
    OR numDocumento LIKE :busqueda
    AND paciente.estado=1");
    $busquedaParam = '%'.$busquedaValidada.'%';
    $stmt->bindParam(":busqueda",$busquedaParam);
    $stmt->execute();
}
$datos_pacientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
include("lista_pacientes.php");
?>