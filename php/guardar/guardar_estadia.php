<?php
session_start();

if (!isset($_SESSION['logged_in']) || isset($_COOKIE['logged_in']) && $_COOKIE['logged_in']) {
    $_SESSION['usuario'] = $_COOKIE['usuario'] ?? '';
    $_SESSION['rol'] = $_COOKIE['rol'] ?? '';
    $_SESSION['logged_in'] = true;
    $_SESSION['idEmpleado'] = $_COOKIE['idEmpleado'] ?? '';
    $_SESSION['nombre_completo'] = $_COOKIE['nombre_completo'] ?? '';
}

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
  header("Location: ../../html/log-in.html");
  exit();
}

include_once '../../config/conection.php';
$conn = conectarDB();

// Activar excepciones en MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fechaInicio_estadia = $_POST['fechaInicio_estadia'];
    $fechaFin_estadia = $_POST['fechaFin_estadia'];
    $costo_estadia = trim($_POST['costo_estadia']);
    $id_habitacion_estadia = trim($_POST['id_habitacion_estadia']);

    if( empty($fechaInicio_estadia) || empty($fechaFin_estadia) || empty($costo_estadia) || empty($id_habitacion_estadia)) {
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

    // Validar si las fechas se superponen con otra estadía en la misma habitación
    $sql_check = "SELECT COUNT(*) FROM estadia 
                  WHERE Habitacion_idHabitacion = ? 
                  AND (
                        (Fecha_Inicio <= ? AND Fecha_Fin >= ?) OR
                        (Fecha_Inicio <= ? AND Fecha_Fin >= ?) OR
                        (Fecha_Inicio >= ? AND Fecha_Fin <= ?)
                  )";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param(
        "issssss",
        $id_habitacion_estadia,
        $fechaInicio_estadia, $fechaInicio_estadia,
        $fechaFin_estadia, $fechaFin_estadia,
        $fechaInicio_estadia, $fechaFin_estadia
    );
    $stmt_check->execute();
    $stmt_check->bind_result($count);
    $stmt_check->fetch();
    $stmt_check->close();

    if ($count > 0) {
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
                    title: 'Fechas en conflicto',
                    text: 'Ya existe una estadía registrada para esa habitación en las fechas seleccionadas.',
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
        $sql = "INSERT INTO estadia (Fecha_Inicio, Fecha_Fin, Costo, Habitacion_idHabitacion)
                VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdi", $fechaInicio_estadia, $fechaFin_estadia, $costo_estadia, $id_habitacion_estadia);
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
                    title: 'Estadía registrada',
                    text: 'La estadía se ha guardado correctamente.',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    window.location.href = '../adminsite.php';
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
                        text: 'Hubo un problema al registrar la estadía.',
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

