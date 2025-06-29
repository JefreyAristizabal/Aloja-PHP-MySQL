<?php
session_start();

if (!isset($_SESSION['logged_in']) && isset($_COOKIE['logged_in']) && $_COOKIE['logged_in']) {
    $_SESSION['usuario'] = $_COOKIE['usuario'] ?? '';
    $_SESSION['rol'] = $_COOKIE['rol'] ?? '';
    $_SESSION['logged_in'] = true;
    $_SESSION['idEmpleado'] = $_COOKIE['idEmpleado'] ?? '';
    $_SESSION['nombre_completo'] = $_COOKIE['nombre_completo'] ?? '';
}

include '../../config/conection.php';
$conn = conectarDB();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: ../../html/log-in.html");
    exit();
}

// Clave de 256 bits (hex)
$key_hex = '14485940e7b744fc60867fcc77c96fe28c29cbe15a668ba6b4e7dc8bb38814e1';

function encrypt_password($password, $key_hex) {
    $key = hex2bin($key_hex);
    $iv = openssl_random_pseudo_bytes(16);
    $encrypted = openssl_encrypt($password, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
    return base64_encode($iv . $encrypted);
}

function decrypt_password($encrypted_base64, $key_hex) {
    $key = hex2bin($key_hex);
    $data = base64_decode($encrypted_base64);
    $iv = substr($data, 0, 16);
    $encrypted = substr($data, 16);
    return openssl_decrypt($encrypted, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
}

$idEmpleado = $_SESSION['idEmpleado'];
$actual = $_POST['actual'] ?? '';
$nueva = $_POST['nueva'] ?? '';
$confirmar = $_POST['confirmar'] ?? '';

if (empty($actual) || empty($nueva) || empty($confirmar)) {
    $mensaje = "Todos los campos son obligatorios.";
    $icon = "warning";
} elseif ($nueva !== $confirmar) {
    $mensaje = "La nueva contraseña y la confirmación no coinciden.";
    $icon = "error";
} else {
    // Obtener contraseña cifrada actual
    $stmt = $conn->prepare("SELECT Password FROM empleado WHERE idEmpleado = ?");
    $stmt->bind_param("i", $idEmpleado);
    $stmt->execute();
    $stmt->bind_result($encryptedDB);
    $stmt->fetch();
    $stmt->close();

    $passActual = decrypt_password($encryptedDB, $key_hex);

    if ($passActual !== $actual) {
        $mensaje = "La contraseña actual no es correcta.";
        $icon = "error";
    } else {
        // Cifrar nueva contraseña
        $encryptedNueva = encrypt_password($nueva, $key_hex);

        $update = $conn->prepare("UPDATE empleado SET Password = ? WHERE idEmpleado = ?");
        $update->bind_param("si", $encryptedNueva, $idEmpleado);
        if ($update->execute()) {
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
                        title: 'Contraseña actualizada',
                        text: 'Tu contraseña se ha cambiado correctamente.',
                        confirmButtonText: 'Aceptar'
                    }).then(() => {
                        window.location.href = '../../index.php';
                    });
                </script>
            </body>
            </html>";
            exit();
        } else {
            $mensaje = "Error al actualizar la contraseña.";
            $icon = "error";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>
    <script>
        Swal.fire({
            icon: '<?= $icon ?>',
            title: 'Atención',
            text: '<?= $mensaje ?>',
            confirmButtonText: 'Volver'
        }).then(() => {
            window.history.back();
        });
    </script>
</body>
</html>
