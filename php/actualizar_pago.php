<?php 
include '../config/conection.php';
$conn = conectarDB();

// Habilita el reporte de errores con excepciones
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $id = $_POST['id'];
    $fecha_pago = $_POST['fecha_pago'];
    $valor_pago = $_POST['valor_pago'];
    $id_huesped_pago = $_POST['id_huesped_pago'];
    $id_estadia_pago = $_POST['id_estadia_pago'];
    $id_empleado_pago = $_POST['id_empleado_pago'];
    $observacion = $_POST['observacion'];

    $rutaImagen = null;

    try {
        // Paso 1: Obtener imagen actual
        $sqlImagenActual = "SELECT Imagen FROM pagos WHERE idPagos = ?";
        $stmtImagen = $conn->prepare($sqlImagenActual);
        $stmtImagen->bind_param("i", $id);
        $stmtImagen->execute();
        $stmtImagen->bind_result($imagenAnterior);
        $stmtImagen->fetch();
        $stmtImagen->close();

        // Paso 2: Si hay nueva imagen
        if (!empty($_FILES['imagen']['name'])) {
            $imagenNombre = $_FILES['imagen']['name'];
            $imagenTmp = $_FILES['imagen']['tmp_name'];
            $imagenTipo = $_FILES['imagen']['type'];

            $permitidas = ['image/jpeg','image/jpg','image/png','image/webp'];
            if (!in_array($imagenTipo, $permitidas)) {
                echo "
                <!DOCTYPE html>
                <html>
                <head><meta charset='UTF-8'><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script></head>
                <body>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Formato no permitido',
                            text: 'Usa JPG, PNG o WEBP',
                            confirmButtonText: 'Aceptar'
                        }).then(() => {
                            window.history.back();
                        });
                    </script>
                </body>
                </html>";
                exit();
            }

            $carpeta = "imagenes_pagos/";
            if (!is_dir($carpeta)) {
                mkdir($carpeta, 0777, true);
            }

            $nombreImagenFinal = time() . "_" . basename($imagenNombre);
            $rutaImagen = $carpeta . $nombreImagenFinal;
            move_uploaded_file($imagenTmp, $rutaImagen);

            // Eliminar imagen anterior
            if (!empty($imagenAnterior) && file_exists($imagenAnterior)) {
                unlink($imagenAnterior);
            }
        }

        // Paso 3: Actualizar en base de datos
        if ($rutaImagen) {
            $sql_id = "SELECT idHUESPED FROM huesped WHERE numero_documento =" . $id_huesped_pago;
            $res_huesped = $conn->query($sql_id);
            $huesped_pago = $res_huesped->fetch_assoc();
            $sql = "UPDATE pagos SET Fecha_Pago = ?, Valor = ?, HUESPED_idHUESPED = ?, Estadia_idEstadia = ?, Empleado_idEmpleado = ?, Observacion = ?, Imagen = ? WHERE idPagos= ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sdiiissi", $fecha_pago, $valor_pago, $huesped_pago['idHUESPED'], $id_estadia_pago, $id_empleado_pago, $observacion, $rutaImagen, $id);
        } else {
            $sql_id = "SELECT idHUESPED FROM huesped WHERE Numero_documento = '$id_huesped_pago'";
            $res_huesped = $conn->query($sql_id);
            $huesped_pago = $res_huesped->fetch_assoc();
            $sql = "UPDATE pagos SET Fecha_Pago = ?, Valor = ?, HUESPED_idHUESPED = ?, Estadia_idEstadia = ?, Empleado_idEmpleado = ?, Observacion = ? WHERE idPagos= ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sdiiisi", $fecha_pago, $valor_pago, $huesped_pago['idHUESPED'], $id_estadia_pago, $id_empleado_pago, $observacion, $id);
        }

        $stmt->execute();

        // Éxito
        echo "
        <!DOCTYPE html>
        <html>
        <head><meta charset='UTF-8'><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script></head>
        <body>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Actualizado',
                    text: 'El pago fue actualizado correctamente',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    window.location.href = 'adminsite.php';
                });
            </script>
        </body>
        </html>";

    } catch (mysqli_sql_exception $e) {
        // Verifica si el error es por clave foránea inválida
        if (strpos($e->getMessage(), 'a foreign key constraint fails') !== false) {
            $mensaje = 'El ID de huésped o estadía no existe. Verifica los datos.';
        } else {
            $mensaje = 'Error al actualizar el pago.';
        }

        echo "
        <!DOCTYPE html>
        <html>
        <head><meta charset='UTF-8'><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script></head>
        <body>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
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

