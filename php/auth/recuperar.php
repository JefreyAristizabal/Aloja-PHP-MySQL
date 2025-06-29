<?php
include '../../config/conection.php';
$conn = conectarDB();

// Clave de 256 bits (64 caracteres hexadecimales)
$key_hex = '14485940e7b744fc60867fcc77c96fe28c29cbe15a668ba6b4e7dc8bb38814e1';

function encrypt_password($password, $key_hex) {
    $key = hex2bin($key_hex);
    $iv = openssl_random_pseudo_bytes(16);
    $encrypted = openssl_encrypt($password, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
    return base64_encode($iv . $encrypted);
}

function generate_random_password($length = 10) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#$!%*?';
    return substr(str_shuffle(str_repeat($chars, ceil($length / strlen($chars)))), 0, $length);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['user']);
    $nombre = trim($_POST['nombre']);

    // Buscar coincidencia exacta
    $sql = "SELECT idEmpleado FROM empleado WHERE Usuario = ? AND Nombre_Completo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usuario, $nombre);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        // Usuario válido → generar nueva contraseña
        $stmt->bind_result($idEmpleado);
        $stmt->fetch();

        $nuevaPass = generate_random_password();
        $encryptedPassword = encrypt_password($nuevaPass, $key_hex);

        $update = $conn->prepare("UPDATE empleado SET Password = ? WHERE idEmpleado = ?");
        $update->bind_param("si", $encryptedPassword, $idEmpleado);
        $update->execute();

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
                    title: 'Contraseña restablecida',
                    html: 'Tu nueva contraseña es:<br><strong>$nuevaPass</strong>',
                    confirmButtonText: 'Iniciar sesión'
                }).then(() => {
                    window.location.href = '../../html/log-in.html';
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
                    title: 'Datos incorrectos',
                    text: 'No se encontró ningún usuario con esos datos.',
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
