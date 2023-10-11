<?php
include("../db.php");
$id = file_get_contents("php://input");
$stmt = $conn->prepare("UPDATE especialidad SET estado=0 WHERE idEspecialidad=:id");
$stmt->bindParam(":id",$id);
$stmt->execute();
?>