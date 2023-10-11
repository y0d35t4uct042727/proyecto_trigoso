<?php
$server = "localhost";
$db = "db_dashboard";
$user = "root";
$pass = "";
try {
    $conn = new PDO("mysql:host=$server;dbname=$db",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);    
} catch (PDOException $e) {
    echo "Error: ".$e->getMessage();
}
?>