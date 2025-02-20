<?php
//DATOS CONEXIÓN A BASE DE DATOS, DEBE COINCIDIR CON EL Dockerfile
$servername = "db"; //PMA_HOST (en compose.yaml)
$username = "fernanda"; //MYSQL_USER (usuario base de datos)
$password = "fernanda"; //MYSQL_PASWORD (contraseña base de datos)
$dbname = "cine";  //MYSQL_DATABASE (nombre base de datos)
// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);
// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>