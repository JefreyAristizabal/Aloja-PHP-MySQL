<?php
include_once '../config/conection.php';
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

    $sql = "INSERT INTO huesped (Nombre_completo, tipo_documento, Numero_documento, Telefono_huesped, Origen, Nombre_Contacto, Telefono_contacto, Observaciones, observaciones2)
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
                    window.location.href = 'adminsite.php';
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
                    window.location.href = 'adminsite.php';
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

