<?php
session_start();

if (!isset($_SESSION['logged_in']) || isset($_COOKIE['logged_in']) && $_COOKIE['logged_in']) {
    $_SESSION['usuario'] = $_COOKIE['usuario'] ?? '';
    $_SESSION['rol'] = $_COOKIE['rol'] ?? '';
    $_SESSION['logged_in'] = true;
    $_SESSION['idEmpleado'] = $_COOKIE['idEmpleado'] ?? '';
    $_SESSION['nombre_completo'] = $_COOKIE['nombre_completo'] ?? '';
}

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] || $_SESSION['rol'] !== 'ADMIN') {
  header("Location: ../../html/log-in.html");
  exit();
}

include_once '../../config/conection.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = conectarDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $modalidad_tarifa = trim($_POST['modalidad_tarifa']);
    $nro_huespedes_tarifa = trim($_POST['nro_huespedes_tarifa']);
    $valor_tarifa = trim($_POST['valor_tarifa']);
    $id_habitacion_tarifa = trim($_POST['id_habitacion_tarifa']);

    if( empty($modalidad_tarifa) || empty($nro_huespedes_tarifa) || empty($valor_tarifa) || empty($id_habitacion_tarifa)) {
        echo "
        <!DOCTYPE html>
        <html>
        <head><meta charset='UTF-8'><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script></head>
        <body>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Campos incompletos',
                    text: 'Por favor, completa todos los campos.',
                    confirmButtonText: 'Volver'
                }).then(() => {
                    window.history.back();
                });
            </script>
        </body>
        </html>";
        exit();
    }

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
                    window.location.href = '../adminsite.php';
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
                    window.location.href = '../adminsite.php';
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
