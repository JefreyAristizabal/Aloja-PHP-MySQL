<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
session_start();
include '../../config/conection.php'; 

function decrypt_password($encryptedData, $key_hex) {
    $key = hex2bin($key_hex);
    $data = base64_decode($encryptedData);
    $iv = substr($data, 0, 16);
    $cipherText = substr($data, 16);

    return openssl_decrypt($cipherText, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
}

$key_hex = '14485940e7b744fc60867fcc77c96fe28c29cbe15a668ba6b4e7dc8bb38814e1';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['user'];
    $password = $_POST['password'];

    $conn = conectarDB(); 
  
    $query = "SELECT * FROM empleado WHERE Usuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $usuario); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        $decryptedPassword = decrypt_password($row['Password'], $key_hex);

        if ($password === $decryptedPassword) {
            // Iniciar sesión
            $_SESSION['usuario'] = $row['Usuario'];
            $_SESSION['rol'] = $row['Rol'];
            $_SESSION['nombre_completo'] = $row['Nombre_Completo'];
            $_SESSION['idEmpleado'] = $row['idEmpleado'];
            $_SESSION['logged_in'] = true;

            // Establecer cookies válidas por 1 día
            $expira = time() + 86400; // 24 horas
            setcookie('usuario', $row['Usuario'], $expira, "/");
            setcookie('idEmpleado', $row['idEmpleado'], $expira, "/");
            setcookie('nombre_completo', $row['Nombre_Completo'], $expira, "/");
            setcookie('rol', $row['Rol'], $expira, "/");
            setcookie('logged_in', true, $expira, "/");

            // Redirigir según rol
            if ($row['Rol'] === 'ADMIN') {
                header("Location: ../adminsite.php");
                exit();
            } elseif ($row['Rol'] === 'EMPLEADO') {
                header("Location: ../panelempleado.php");
                exit();
            }
        }
    }

    // Error en login
    echo "
    <!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <title>Login</title>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
        <script>
          Swal.fire({
            icon: 'error',
            title: 'Acceso denegado',
            text: 'Usuario o contraseña incorrectos',
            confirmButtonColor: '#d33'
          }).then(() => {
            window.location.href = '../../html/log-in.html';
          });
        </script>
    </body>
    </html>
    ";

    $stmt->close();
    $conn->close();
}
?>
