<?php

include_once '../config/conection.php';
$conn = conectarDB();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idPago = $_GET['id'];

    // Paso 1: Obtener la ruta de la imagen
    $sqlImagen = "SELECT Imagen FROM pagos WHERE idPagos = ?";
    $stmtImagen = $conn->prepare($sqlImagen);
    $stmtImagen->bind_param("i", $idPago);
    $stmtImagen->execute();
    $stmtImagen->bind_result($rutaImagen);
    $stmtImagen->fetch();
    $stmtImagen->close();

    // Paso 2: Eliminar el archivo si existe
    if (!empty($rutaImagen) && file_exists($rutaImagen)) {
        unlink($rutaImagen);
    }

    // Paso 3: Eliminar el registro de la base de datos
    $sql = "DELETE FROM pagos WHERE idPagos = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idPago); // Aquí también había un error, estabas usando $idTarifa

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
                    title: 'Pago eliminado',
                    text: 'El pago fue eliminado correctamente.',
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
                    title: 'Error',
                    text: 'No se pudo eliminar el pago.',
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
                icon: 'warning',
                title: 'ID inválido',
                text: 'No se ha proporcionado un ID válido para eliminar.',
                confirmButtonText: 'Volver'
            }).then(() => {
                window.location.href = 'adminsite.php';
            });
        </script>
    </body>
    </html>";
    exit();
}

$conn->close();
?>
