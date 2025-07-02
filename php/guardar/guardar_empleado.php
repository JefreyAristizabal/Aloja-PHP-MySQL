<?php
session_start();

if (!isset($_SESSION['logged_in']) || isset($_COOKIE['logged_in']) && $_COOKIE['logged_in']) {
    $_SESSION['usuario'] = $_COOKIE['usuario'] ?? '';
    $_SESSION['rol'] = $_COOKIE['rol'] ?? '';
    $_SESSION['logged_in'] = true;
    $_SESSION['idEmpleado'] = $_COOKIE['idEmpleado'] ?? '';
    $_SESSION['nombre_completo'] = $_COOKIE['nombre_completo'] ?? '';
}

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] || $_SESSION['rol'] !== 'ADMIN') {
  header("Location: ../../html/log-in.html");
  exit();
}

include_once '../../config/conection.php';
$conn = conectarDB();

// Configuración segura
$key_hex = '14485940e7b744fc60867fcc77c96fe28c29cbe15a668ba6b4e7dc8bb38814e1'; // Reemplaza por tu clave segura generada con random_bytes(32)
$key = hex2bin($key_hex);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $empleado_nombre = trim($_POST['empleado_nombre']);
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);
    $rol = $_POST['rol'];

    if( empty($empleado_nombre) || empty($usuario) || empty($password) || empty($rol)) {
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
                    title: 'Campos incompletos',
                    text: 'Por favor, completa todos los campos.',
                    confirmButtonText: 'Volver'
                }).then(() => {
                    window.history.back();
                });
            </script>
        </body>
        </html>";
        exit();
    }

    // Validar si ya existe un empleado con el mismo nombre
    $sql_check = "SELECT idEmpleado FROM empleado WHERE Usuario = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $usuario);
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

    // Cifrado seguro de la contraseña
    $iv = random_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $cipher_password = openssl_encrypt(
        $password,
        'aes-256-cbc',
        $key,
        0,
        $iv
    );
    $password_cifrada = base64_encode($iv . $cipher_password);

    $sql = "INSERT INTO empleado (Nombre_Completo, Usuario, Password, Rol)
            VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $empleado_nombre, $usuario, $password_cifrada, $rol);

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
