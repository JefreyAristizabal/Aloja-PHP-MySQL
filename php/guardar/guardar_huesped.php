<?php
session_start();

if (!isset($_SESSION['logged_in']) || isset($_COOKIE['logged_in']) && $_COOKIE['logged_in']) {
    $_SESSION['usuario'] = $_COOKIE['usuario'] ?? '';
    $_SESSION['rol'] = $_COOKIE['rol'] ?? '';
    $_SESSION['logged_in'] = true;
    $_SESSION['idEmpleado'] = $_COOKIE['idEmpleado'] ?? '';
    $_SESSION['nombre_completo'] = $_COOKIE['nombre_completo'] ?? '';
}

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
  header("Location: ../../html/log-in.html");
  exit();
}

include_once '../../config/conection.php';
$conn = conectarDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_huesped = trim($_POST['nombre_huesped']);
    $tipodocumento = trim($_POST['tipodocumento']);
    $numero_documento_huesped = trim($_POST['numero_documento_huesped']);
    $telefono_huesped = trim($_POST['telefono_huesped']);
    $ciudad_huesped = trim($_POST['ciudad_huesped']);
    $nombre_contacto_huesped = trim($_POST['nombre_contacto_huesped']);
    $telefono_contacto_huesped = trim($_POST['telefono_contacto_huesped']);
    $observaciones_huesped = trim($_POST['observaciones_huesped']);
    $otras_observaciones_huesped = trim($_POST['otras_observaciones_huesped']);

    if(empty($nombre_huesped) || empty($tipodocumento) || empty($numero_documento_huesped) || empty($telefono_huesped) || empty($ciudad_huesped) || empty($nombre_contacto_huesped) || empty($telefono_contacto_huesped) || empty($observaciones_huesped) || empty($otras_observaciones_huesped)) {
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

    // Validar si ya existe un huesped con el mismo número de documento
    $sql_check = "SELECT idHUESPED FROM huesped WHERE numero_documento = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $numero_documento_huesped);
    $stmt_check->execute();
    $stmt_check->store_result();
    if ($stmt_check->num_rows > 0) {
        // Ya existe un huesped con ese número de documento
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
                    title: 'Número de documento duplicado',
                    text: 'Ya existe un huesped registrado con ese número de documento.',
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

    $sql = "INSERT INTO huesped (Nombre_completo, tipo_documento, numero_documento, Telefono_huesped, Origen, Nombre_Contacto, Telefono_contacto, Observaciones, observaciones2)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $nombre_huesped, $tipodocumento, $numero_documento_huesped, $telefono_huesped, $ciudad_huesped, $nombre_contacto_huesped, $telefono_contacto_huesped, $observaciones_huesped, $otras_observaciones_huesped);

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
                    title: 'Huesped registrada',
                    text: 'El huesped se ha guardado correctamente.',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    window.location.href = '../adminsite.php';
                });
            </script>
        </body>
        </html>";
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
                    text: 'Hubo un problema al registrar el huesped.',
                    confirmButtonText: 'Volver'
                }).then(() => {
                    window.location.href = '../adminsite.php';
                });
            </script>
        </body>
        </html>";
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>

