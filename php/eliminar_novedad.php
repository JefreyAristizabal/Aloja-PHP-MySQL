<?php

include_once '../config/conection.php';
$conn = conectarDB();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idNovedad = $_GET['id'];

    $sql = "DELETE FROM novedades WHERE idNovedades = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idNovedad);

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
                    title: 'Novedad eliminada',
                    text: 'La novedad fue eliminada correctamente.',
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
                    text: 'No se pudo eliminar la novedad.',
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