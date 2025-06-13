<?php
include_once '../../config/conection.php';
$conn = conectarDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $empleado_nombre = $_POST['empleado_nombre'];
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $rol = $_POST['rol'];

    // Validar si ya existe un empleado con el mismo nombre
    $sql_check = "SELECT idEmpleado FROM empleado WHERE Usuario = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $usuario);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        // Ya existe un empleado con ese nombre
        echo "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Usuario duplicado',
                    text: 'Ya existe un empleado registrado con ese usuario.',
                    confirmButtonText: 'Volver'
                }).then(() => {
                    window.history.back();
                });
            </script>
        </body>
        </html>";
        $stmt_check->close();
        $conn->close();
        exit();
    }
    $stmt_check->close();

    $sql = "INSERT INTO empleado (Nombre_Completo, Usuario, Password, Rol)
            VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $empleado_nombre, $usuario, $password, $rol);

    if ($stmt->execute()) {
        echo "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Empleado registrado',
                    text: 'El empleado se ha guardado correctamente.',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    window.location.href = '../adminsite.php';
                });
            </script>
        </body>
        </html>";
        $stmt->close();
        $conn->close();
        exit();
    } else {
        echo "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error al registrar',
                    text: 'Hubo un problema al registrar el empleado.',
                    confirmButtonText: 'Volver'
                }).then(() => {
                    window.location.href = '../adminsite.php';
                });
            </script>
        </body>
        </html>";
        $stmt->close();
        $conn->close();
        exit();
    }
}
?>