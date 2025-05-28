<?php

include_once '../config/conection.php';

$conexion = conectarDB();
if ($conexion->connect_error) {
  die("Error de conexión");
}

if (isset($_GET['usuario'])) {
  $usuario = $_GET['usuario'];

  $stmt = $conexion->prepare("SELECT * FROM empleado WHERE Usuario = ?");
  $stmt->bind_param("s", $usuario);
  $stmt->execute();
  $resultado = $stmt->get_result();

  if ($resultado->num_rows > 0) {
    echo 'existe';
  } else {
    echo 'disponible';
  }

  $stmt->close();
}
$conexion->close();
?>
