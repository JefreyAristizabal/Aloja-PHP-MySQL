<?php
function conectarDB() {
    $host = "localhost:3307"; 
    $user = "root"; 
    $password = ""; 
    $database = "adminaloja"; 

    $conn = new mysqli($host, $user, $password, $database);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }
    return $conn;
}
?>