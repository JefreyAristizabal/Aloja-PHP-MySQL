<?php
include_once '../config/conection.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = conectarDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $modalidad_tarifa = $_POST['modalidad_tarifa'];
    $nro_huespedes_tarifa = $_POST['nro_huespedes_tarifa'];
    $valor_tarifa = $_POST['valor_tarifa'];
    $id_habitacion_tarifa = $_POST['id_habitacion_tarifa'];

    try {
        $sql = "INSERT INTO tarifa (Modalidad, NroHuespedes, Valor, Habitacion_idHabitacion)
                VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sisi", $modalidad_tarifa, $nro_huespedes_tarifa, $valor_tarifa, $id_habitacion_tarifa);
        $stmt->execute();

        echo "
        <!DOCTYPE html>
        <html>
        <head><meta charset='UTF-8'><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script></head>
        <body>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Tarifa registrada',
                    text: 'La tarifa se ha guardado correctamente.',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    window.location.href = 'adminsite.php';
                });
            </script>
        </body>
        </html>";
        exit();

    } catch (mysqli_sql_exception $e) {
        $mensaje = 'Hubo un problema al registrar la tarifa.';

        if (strpos($e->getMessage(), 'a foreign key constraint fails') !== false) {
            $mensaje = 'El ID de la habitación ingresada no existe. Verifica los datos.';
        }

        echo "
        <!DOCTYPE html>
        <html>
        <head><meta charset='UTF-8'><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script></head>
        <body>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error al registrar',
                    text: '$mensaje',
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
