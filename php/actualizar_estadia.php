<?php 
include '../config/conection.php';
$conn = conectarDB();

// Activar excepciones de MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $fechaInicio = $_POST['fechaInicio_estadia'];
    $fechaFin = $_POST['fechaFin_estadia'];
    $costo = $_POST['costo_estadia'];
    $idHabitacion = $_POST['id_habitacion_estadia'];

    try {
        $sql = "UPDATE estadia SET Fecha_Inicio = ?, Fecha_Fin = ?, Costo = ?, Habitacion_idHabitacion = ? WHERE idEstadia = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdii", $fechaInicio, $fechaFin, $costo, $idHabitacion, $id);
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
                    text: 'La estadía fue actualizada correctamente.',
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
            // Error por clave foránea: ID de habitación no existe
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
                        text: 'La habitación que seleccionaste no existe. Verifica el ID e intenta de nuevo.',
                        confirmButtonText: 'Volver'
                    }).then(() => {
                        window.history.back();
                    });
                </script>
            </body>
            </html>";
        } else {
            // Otro tipo de error inesperado
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
                        text: 'Hubo un problema al actualizar la estadía.',
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

