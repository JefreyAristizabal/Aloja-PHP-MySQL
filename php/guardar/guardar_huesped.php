<?php
include_once '../../config/conection.php';
$conn = conectarDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_huesped = $_POST['nombre_huesped'];
    $tipodocumento = $_POST['tipodocumento'];
    $numero_documento_huesped = $_POST['numero_documento_huesped'];
    $telefono_huesped = $_POST['telefono_huesped'];
    $ciudad_huesped = $_POST['ciudad_huesped'];
    $nombre_contacto_huesped = $_POST['nombre_contacto_huesped'];
    $telefono_contacto_huesped = $_POST['telefono_contacto_huesped'];
    $observaciones_huesped = $_POST['observaciones_huesped'];
    $otras_observaciones_huesped = $_POST['otras_observaciones_huesped'];

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

