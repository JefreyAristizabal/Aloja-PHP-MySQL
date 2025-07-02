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

include '../../config/conection.php';
$conn = conectarDB();

// Activar excepciones de MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_huesped_actual = trim($_POST['id_huesped_actual']);
    $id_estadia_actual = trim($_POST['id_estadia_actual']);
    $id_huesped_nuevo = trim($_POST['id_huesped_nuevo']);
    $id_estadia_nuevo = trim($_POST['id_estadia_nuevo']);
    if (empty($id_huesped_actual) || empty($id_estadia_actual) || empty($id_huesped_nuevo) || empty($id_estadia_nuevo)) {
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
    $huespedes = $conn->query("SELECT idHUESPED FROM huesped WHERE numero_documento = '$id_huesped_nuevo'");
    $huesped = $huespedes->fetch_assoc();
    if (!$huesped) {
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
                    text: 'El documento del huésped no existe. Por favor, verifica el ID del huésped.',
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
        $sql = "UPDATE huesped_has_estadia 
                SET HUESPED_idHUESPED = ?, Estadia_idEstadia = ? 
                WHERE HUESPED_idHUESPED = ? AND Estadia_idEstadia = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiii", $huesped['idHUESPED'], $id_estadia_nuevo, $id_huesped_actual, $id_estadia_actual);
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
                    window.location.href = '../adminsite.php';
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
