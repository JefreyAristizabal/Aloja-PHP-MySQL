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

// Habilita los errores de mysqli como excepciones
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha_pago = $_POST['fecha_pago'];
    $valor_pago = trim($_POST['valor_pago']);
    $id_huesped_pago = trim($_POST['id_huesped_pago']);
    $id_estadia_pago = trim($_POST['id_estadia_pago']);
    $id_empleado_pago = $_POST['id_empleado_pago'];
    $observacion = trim($_POST['observacion']);

    if( empty($fecha_pago) || empty($valor_pago) || empty($id_huesped_pago) || empty($id_estadia_pago) || empty($id_empleado_pago)) {
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

    // Validar el formato del valor del pago
    if (!is_numeric($valor_pago) || $valor_pago <= 0) {
        echo "
        <!DOCTYPE html>
        <html>
        <head><meta charset='UTF-8'><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script></head>
        <body>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Valor inválido',
                    text: 'El valor del pago debe ser un número positivo.',
                    confirmButtonText: 'Volver'
                }).then(() => {
                    window.history.back();
                });
            </script>
        </body>
        </html>";
        exit();
    }
    

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
    
        if (!move_uploaded_file($imagenTmp, "../" . $rutaImagen)) {
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
                    window.location.href = '../adminsite.php';
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
