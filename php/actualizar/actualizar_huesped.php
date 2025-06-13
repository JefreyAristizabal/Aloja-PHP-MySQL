<?php 
include '../../config/conection.php';
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

    // Validar si ya existe un huesped con el mismo número de documento
    $sql_check = "SELECT idHUESPED FROM huesped WHERE numero_documento = ? AND idHUESPED != ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("si", $numero_documento_huesped, $id);
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

    $stmt_check->close();

    $sql = "UPDATE huesped SET Nombre_completo = ?, tipo_documento = ?, numero_documento = ?, Telefono_huesped = ?, Origen = ?, Nombre_Contacto = ?, Telefono_contacto = ?, Observaciones = ?, observaciones2 = ? WHERE idHUESPED = ?";
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
