<?php

include_once '../config/conection.php';
$conn = conectarDB();

if (isset($_GET['idhuesped']) && isset($_GET['idestadia']) && is_numeric($_GET['idhuesped']) && is_numeric($_GET['idestadia'])) {
    $idhuesped = $_GET['idhuesped'] ?? null;
    $idestadia = $_GET['idestadia'] ?? null;

    $sql = "DELETE FROM huesped_has_estadia WHERE HUESPED_idHUESPED = ? AND Estadia_idEstadia = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $idhuesped, $idestadia);

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
                    title: 'Huesped x Estadía eliminada',
                    text: 'El Huesped x Estadía fue eliminada correctamente.',
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
                    text: 'No se pudo eliminar el Huesped x Estadía.',
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