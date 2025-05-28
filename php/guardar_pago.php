<?php
include '../config/conection.php';

// Habilita los errores de mysqli como excepciones
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha_pago = $_POST['fecha_pago'];
    $valor_pago = $_POST['valor_pago'];
    $id_huesped_pago = $_POST['id_huesped_pago'];
    $id_estadia_pago = $_POST['id_estadia_pago'];
    $id_empleado_pago = $_POST['id_empleado_pago'];
    $observacion = $_POST['observacion'];

    $carpetaDestino = "imagenes_pagos/";

    if (!is_dir($carpetaDestino)) {
        mkdir($carpetaDestino, 0777, true);
    }

    $imagenNombre = $_FILES['imagen']['name'];
    $imagenTmp = $_FILES['imagen']['tmp_name'];
    $imagenTipo = $_FILES['imagen']['type'];

    $rutaImagen = null;

    if (!empty($imagenNombre)) {
        $extensionesPermitidas = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
        if (!in_array($imagenTipo, $extensionesPermitidas)) {
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
    
        $nombreImagenFinal = time() . "_" . basename($imagenNombre);
        $rutaImagen = $carpetaDestino . $nombreImagenFinal;
    
        if (!move_uploaded_file($imagenTmp, $rutaImagen)) {
            echo "
            <!DOCTYPE html>
        <html>
        <head><meta charset='UTF-8'><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script></head>
        <body>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error con la imagen',
                    text: 'No se pudo subir la imagen.',
                    confirmButtonText: 'Volver'
                }).then(() => {
                    window.history.back();
                });
            </script>
        </body>
        </html>";
            exit();
        }
    }

    try {
        $conn = conectarDB();

        $sql_id = "SELECT idHUESPED FROM huesped WHERE numero_documento =" . $id_huesped_pago;
        $res_huesped = $conn->query($sql_id);
        $huesped_pago = $res_huesped->fetch_assoc();

        $sql = "INSERT INTO pagos (Fecha_Pago, Valor, Empleado_idEmpleado, Estadia_idEstadia, HUESPED_idHUESPED, Observacion, Imagen)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sdiiiss', $fecha_pago, $valor_pago, $id_empleado_pago, $id_estadia_pago, $huesped_pago['idHUESPED'], $observacion, $rutaImagen);
        $stmt->execute();

        echo "
        <!DOCTYPE html>
        <html>
        <head><meta charset='UTF-8'><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script></head>
        <body>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Pago registrado',
                    text: 'El pago se ha guardado correctamente.',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    window.location.href = 'adminsite.php';
                });
            </script>
        </body>
        </html>";
        exit();

    } catch (mysqli_sql_exception $e) {
        $mensaje = 'Hubo un problema al registrar el pago.';

        // Detecta error por clave foránea inválida
        if (strpos($e->getMessage(), 'a foreign key constraint fails') !== false) {
            $mensaje = 'El ID de huésped o estadía no existe. Verifica los datos ingresados.';
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
