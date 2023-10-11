<?php
include("../db.php");
$id = file_get_contents("php://input");
$stmt = $conn->prepare("UPDATE tipo_profesion SET estado=0 WHERE idTipoProfesion=:id");
$stmt->bindParam(":id",$id);
$stmt->execute();
?>