<?php

include_once '../config/conection.php';
$conn = conectarDB();

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idEstadia = $_GET['id'];

    try {
        $sql = "DELETE FROM estadia WHERE idEstadia = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idEstadia);
        $stmt->execute();

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
                    title: 'Estadía eliminada',
                    text: 'La estadía fue eliminada correctamente.',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    window.location.href = 'adminsite.php';
                });
            </script>
        </body>
        </html>";
        exit();

    } catch (mysqli_sql_exception $e) {
        if (strpos($e->getMessage(), 'a foreign key constraint fails') !== false) {
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
                        title: 'No se puede eliminar',
                        text: 'Esta estadía está asociada a un registro de otra tabla. Elimina primero la relación antes de continuar.',
                        confirmButtonText: 'Volver'
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
                        title: 'Error inesperado',
                        text: 'Ha ocurrido un error inesperado al intentar eliminar.',
                        confirmButtonText: 'Volver'
                    }).then(() => {
                        window.location.href = 'adminsite.php';
                    });
                </script>
            </body>
            </html>";
            exit();
        }
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
