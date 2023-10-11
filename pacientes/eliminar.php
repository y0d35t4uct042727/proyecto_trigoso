<?php
include("../db.php");
$id = file_get_contents("php://input");
$stmt = $conn->prepare("UPDATE paciente SET estado=0 WHERE idPaciente=:id");
$stmt->bindParam(":id",$id);
$stmt->execute();
?>