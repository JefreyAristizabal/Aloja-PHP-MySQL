<?php 
include '../config/conection.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = conectarDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $descripcion_novedad = $_POST['descripcion_novedad'];
    $id_estadia_novedad = $_POST['id_estadia_novedad'];

    try {
        $sql = "UPDATE novedades 
                SET Descripcion = ?, Estadia_idEstadia = ? 
                WHERE idNovedades = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sii", $descripcion_novedad, $id_estadia_novedad, $id);
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
                    text: 'La novedad fue actualizada correctamente',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    window.location.href = 'adminsite.php';
                });
            </script>
        </body>
        </html>";
        exit();

    } catch (mysqli_sql_exception $e) {
        $mensaje = "Hubo un problema al actualizar la novedad.";

        if (strpos($e->getMessage(), 'a foreign key constraint fails') !== false) {
            $mensaje = "El ID de estadía especificado no existe. Verifica los datos.";
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