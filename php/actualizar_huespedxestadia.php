<?php 
include '../config/conection.php';
$conn = conectarDB();

// Activar excepciones de MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_huesped_actual = $_POST['id_huesped_actual'];
    $id_estadia_actual = $_POST['id_estadia_actual'];
    $id_huesped_nuevo = $_POST['id_huesped_nuevo'];
    $id_estadia_nuevo = $_POST['id_estadia_nuevo'];

    try {
        $sql = "UPDATE huesped_has_estadia 
                SET HUESPED_idHUESPED = ?, Estadia_idEstadia = ? 
                WHERE HUESPED_idHUESPED = ? AND Estadia_idEstadia = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiii", $id_huesped_nuevo, $id_estadia_nuevo, $id_huesped_actual, $id_estadia_actual);
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
                    title: 'Actualizado',
                    text: 'El Huesped x Estadía fue actualizado correctamente.',
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
            // Error por clave foránea: huesped o estadía no existe
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
                        title: 'Error de relación',
                        text: 'El ID de huésped o de estadía que seleccionaste no existe. Verifica los datos e intenta de nuevo.',
                        confirmButtonText: 'Volver'
                    }).then(() => {
                        window.history.back();
                    });
                </script>
            </body>
            </html>";
        } else {
            // Otro error inesperado
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
                        text: 'Hubo un problema al actualizar la relación Huesped x Estadía.',
                        confirmButtonText: 'Volver'
                    }).then(() => {
                        window.history.back();
                    });
                </script>
            </body>
            </html>";
        }
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
