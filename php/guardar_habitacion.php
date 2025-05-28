<?php
include '../config/conection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_habitacion = $_POST['nombre_habitacion'];
    $capacidad = $_POST['capacidad'];
    $descripcion_habitacion = $_POST['descripcion_habitacion'];

    $carpetaDestino = "imagenes_habitaciones/";

    if (!is_dir($carpetaDestino)) {
        mkdir($carpetaDestino, 0777, true);
    }

    $imagenNombre = $_FILES['imagen']['name'];
    $imagenTmp = $_FILES['imagen']['tmp_name'];
    $imagenTipo = $_FILES['imagen']['type'];

    $extensionesPermitidas = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];
    if (!in_array($imagenTipo, $extensionesPermitidas)) {
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
    

    $nombreImagenFinal = time() . "_" . basename($imagenNombre);
    $rutaImagen = $carpetaDestino . $nombreImagenFinal;

    if (move_uploaded_file($imagenTmp, $rutaImagen)) {
        $conn = conectarDB();
        $sql = "INSERT INTO HABITACION (NOMBRE, CAPACIDAD, DESCRIPCION, IMAGEN) VALUES (?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siss", $nombre_habitacion, $capacidad, $descripcion_habitacion, $rutaImagen);

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
                        title: 'Habitación registrada',
                        text: 'La habitación se ha guardado correctamente.',
                        confirmButtonText: 'Aceptar'
                    }).then(() => {
                        window.location.href = 'adminsite.php';
                    });
                </script>
            </body>
            </html>";
            exit();
            
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
                        title: 'Error al registrar',
                        text: 'Hubo un problema al registrar la habitación.',
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
                        title: 'Error con la imagen',
                        text: 'Error al subir la imagen.',
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
?>
