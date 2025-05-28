<?php
include_once '../config/conection.php';
$conn = conectarDB();

// Activar el modo de reporte de errores como excepciones
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_huesped = $_POST['id_huesped'];
    $id_estadia = $_POST['id_estadia'];

    try {
        $sql = "INSERT INTO huesped_has_estadia (HUESPED_idHUESPED, Estadia_idEstadia)
                VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $id_huesped, $id_estadia);
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
                    title: 'Huésped x Estadía registrada',
                    text: 'La relación huésped x estadía fue guardada correctamente.',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    window.location.href = 'adminsite.php';
                });
            </script>
        </body>
        </html>";
        exit();

    } catch (mysqli_sql_exception $e) {
        // Verifica si es un error por clave foránea
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
                        text: 'El ID de huésped o estadía ingresado no existe. Verifica los datos e intenta de nuevo.',
                        confirmButtonText: 'Volver'
                    }).then(() => {
                        window.history.back();
                    });
                </script>
            </body>
            </html>";
        } else {
            // Otro tipo de error
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
                        text: 'Hubo un problema al registrar la relación huésped x estadía.',
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


