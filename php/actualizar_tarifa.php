<?php 
include '../config/conection.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = conectarDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $modalidad_tarifa = $_POST['modalidad_tarifa'];
    $nro_huespedes_tarifa = $_POST['nro_huespedes_tarifa'];
    $valor_tarifa = $_POST['valor_tarifa'];
    $id_habitacion_tarifa = $_POST['id_habitacion_tarifa'];

    try {
        $sql = "UPDATE tarifa 
                SET Modalidad = ?, NroHuespedes = ?, Valor = ?, Habitacion_idHabitacion = ? 
                WHERE idTarifa = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sidii", $modalidad_tarifa, $nro_huespedes_tarifa, $valor_tarifa, $id_habitacion_tarifa, $id);
        $stmt->execute();

        echo "
        <!DOCTYPE html>
        <html>
        <head><meta charset='UTF-8'><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script></head>
        <body>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Actualizado',
                    text: 'La tarifa fue actualizada correctamente',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    window.location.href = 'adminsite.php';
                });
            </script>
        </body>
        </html>";
        exit();

    } catch (mysqli_sql_exception $e) {
        $mensaje = "Hubo un problema al actualizar la tarifa.";

        if (strpos($e->getMessage(), 'a foreign key constraint fails') !== false) {
            $mensaje = "El ID de habitación especificado no existe. Verifica los datos.";
        }

        echo "
        <!DOCTYPE html>
        <html>
        <head><meta charset='UTF-8'><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script></head>
        <body>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error al actualizar',
                    text: '$mensaje',
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
