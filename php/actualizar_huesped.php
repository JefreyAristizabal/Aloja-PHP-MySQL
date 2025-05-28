<?php 
include '../config/conection.php';
$conn = conectarDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre_huesped = $_POST['nombre_huesped'];
    $tipodocumento = $_POST['tipodocumento'];
    $numero_documento_huesped = $_POST['numero_documento_huesped'];
    $telefono_huesped = $_POST['telefono_huesped'];
    $ciudad_huesped = $_POST['ciudad_huesped'];
    $nombre_contacto_huesped = $_POST['nombre_contacto_huesped'];
    $telefono_contacto_huesped = $_POST['telefono_contacto_huesped'];
    $observaciones_huesped = $_POST['observaciones_huesped'];
    $otras_observaciones_huesped = $_POST['otras_observaciones_huesped'];

    $sql = "UPDATE huesped SET Nombre_completo = ?, tipo_documento = ?, Numero_documento = ?, Telefono_huesped = ?, Origen = ?, Nombre_Contacto = ?, Telefono_contacto = ?, Observaciones = ?, observaciones2 = ? WHERE idHUESPED = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssi", $nombre_huesped, $tipodocumento, $numero_documento_huesped, $telefono_huesped, $ciudad_huesped, $nombre_contacto_huesped, $telefono_contacto_huesped, $observaciones_huesped, $otras_observaciones_huesped, $id);

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
                    text: 'El huesped fue actualizado correctamente',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    window.location.href = 'adminsite.php';
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
                    text: 'Hubo un problema al actualizar el huesped.',
                    confirmButtonText: 'Volver'
                }).then(() => {
                    window.history.back();
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
