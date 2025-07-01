<?php
session_start();

if (!isset($_SESSION['logged_in']) && isset($_COOKIE['logged_in']) && $_COOKIE['logged_in']) {
    $_SESSION['usuario'] = $_COOKIE['usuario'] ?? '';
    $_SESSION['rol'] = $_COOKIE['rol'] ?? '';
    $_SESSION['logged_in'] = true;
    $_SESSION['idEmpleado'] = $_COOKIE['idEmpleado'] ?? '';
    $_SESSION['nombre_completo'] = $_COOKIE['nombre_completo'] ?? '';
}

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] || $_SESSION['rol'] !== 'ADMIN') {
  header("Location: ../html/log-in.html");
  exit();
}

include '../../config/conection.php';
$conn = conectarDB();

// Clave de 256 bits en formato hexadecimal (64 caracteres)
$key_hex = '14485940e7b744fc60867fcc77c96fe28c29cbe15a668ba6b4e7dc8bb38814e1'; // Cámbiala por una segura

function encrypt_password($password, $key_hex) {
    $key = hex2bin($key_hex);
    $iv = openssl_random_pseudo_bytes(16);
    $encrypted = openssl_encrypt($password, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
    return base64_encode($iv . $encrypted); // IV + texto cifrado
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $empleado_nombre = $_POST['empleado_nombre'];
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $rol = $_POST['rol'];

    // Verificar usuario duplicado excepto este
    $sql_check = "SELECT idEmpleado FROM empleado WHERE Usuario = ? AND idEmpleado != ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("si", $usuario, $id);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
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
                    title: 'Nombre duplicado',
                    text: 'Ya existe otro empleado registrado con ese nombre.',
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

    // Cifrar la contraseña antes de guardar
    $encryptedPassword = encrypt_password($password, $key_hex);

    if(empty($password)) {
        // Si la contraseña está vacía, no la actualizamos
        $sql = "UPDATE empleado SET Nombre_Completo = ?, Usuario = ?, Rol = ? WHERE idEmpleado = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $empleado_nombre, $usuario, $rol, $id);
    } else {
        // Si hay una nueva contraseña, la ciframos y la actualizamos
        $sql = "UPDATE empleado SET Nombre_Completo = ?, Usuario = ?, Password = ?, Rol = ? WHERE idEmpleado = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $empleado_nombre, $usuario, $encryptedPassword, $rol, $id);
    }

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
                    title: 'Actualizado',
                    text: 'El empleado fue actualizado correctamente',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    window.location.href = '../adminsite.php';
                });
            </script>
        </body>
        </html>";
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
                    title: 'Error',
                    text: 'Hubo un problema al actualizar el empleado.',
                    confirmButtonText: 'Volver'
                }).then(() => {
                    window.history.back();
                });
            </script>
        </body>
        </html>";
    }

    $stmt->close();
    $conn->close();
}
?>
