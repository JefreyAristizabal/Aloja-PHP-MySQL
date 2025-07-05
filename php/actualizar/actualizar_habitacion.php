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

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $id = trim($_POST['id']);
    $nombre = trim($_POST['nombre_habitacion']);
    $capacidad = trim($_POST['capacidad']);
    $descripcion = trim($_POST['descripcion_habitacion']);

    if (empty($id) || empty($nombre) || empty($capacidad) || empty($descripcion)) {
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

    $rutaImagen = null;

    // Paso 1: Obtener imagen actual de la base de datos
    $sqlImagenActual = "SELECT IMAGEN FROM HABITACION WHERE idHABITACION = ?";
    $stmtImagen = $conn->prepare($sqlImagenActual);
    $stmtImagen->bind_param("i", $id);
    $stmtImagen->execute();
    $stmtImagen->bind_result($imagenAnterior);
    $stmtImagen->fetch();
    $stmtImagen->close();

    // Paso 2: Si se subió una nueva imagen
    if (!empty($_FILES['imagen']['name'])) {
        $imagenNombre = $_FILES['imagen']['name'];
        $imagenTmp = $_FILES['imagen']['tmp_name'];
        $imagenTipo = $_FILES['imagen']['type'];

        $permitidas = ['image/jpeg','image/jpg','image/png','image/webp'];
        if (!in_array($imagenTipo, $permitidas)) {
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

        $carpeta = "imagenes_habitaciones/";
        if (!is_dir($carpeta)) {
            mkdir($carpeta, 0777, true);
        }

        $nombreImagenFinal = time() . "_" . basename($imagenNombre);
        $rutaImagen = $carpeta . $nombreImagenFinal;
        move_uploaded_file($imagenTmp, "../" . $rutaImagen);

        // Paso 3: Eliminar la imagen anterior si existe
        if (!empty($imagenAnterior) && file_exists($imagenAnterior)) {
            unlink($imagenAnterior);
        }
    }

    // Paso 4: Actualizar en base de datos
    if ($rutaImagen) {
        $sql = "UPDATE HABITACION SET NOMBRE = ?, CAPACIDAD = ?, DESCRIPCION = ?, IMAGEN = ? WHERE idHABITACION= ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sissi", $nombre, $capacidad, $descripcion, $rutaImagen, $id);
    } else {
        $sql = "UPDATE HABITACION SET NOMBRE = ?, CAPACIDAD = ?, DESCRIPCION = ? WHERE idHABITACION= ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sisi", $nombre, $capacidad, $descripcion, $id);
    }

    if ($stmt->execute()) {
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
                    text: 'La habitacion fue actualizada correctamente',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    window.location.href = '../adminsite.php';
                });
            </script>
        </body>
        </html>";
    } else {
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
                    text: 'Error al actualizar la habitación.',
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