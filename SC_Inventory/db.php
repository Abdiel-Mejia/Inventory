<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; //Cambiar por la contraseña correspondiente
$dbname = "inventory"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>

