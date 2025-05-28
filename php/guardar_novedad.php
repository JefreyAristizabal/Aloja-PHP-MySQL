<?php
include_once '../config/conection.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = conectarDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descripcion_novedad = $_POST['descripcion_novedad'];
    $id_estadia_novedad = $_POST['id_estadia_novedad'];

    try {
        $sql = "INSERT INTO novedades (Descripcion, Estadia_idEstadia)
                VALUES (?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $descripcion_novedad, $id_estadia_novedad);
        $stmt->execute();

        echo "
        <!DOCTYPE html>
        <html>
        <head><meta charset='UTF-8'><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script></head>
        <body>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Novedad registrada',
                    text: 'La novedad se ha guardado correctamente.',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    window.location.href = 'adminsite.php';
                });
            </script>
        </body>
        </html>";
        exit();

    } catch (mysqli_sql_exception $e) {
        $mensaje = 'Hubo un problema al registrar la novedad.';

        if (strpos($e->getMessage(), 'a foreign key constraint fails') !== false) {
            $mensaje = 'El ID de la estadía ingresada no existe. Verifica los datos.';
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
