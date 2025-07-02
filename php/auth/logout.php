<?php
session_start();
setcookie('usuario', '', time() - 3600, '/');
setcookie('rol', '', time() - 3600, '/');
setcookie('logged_in', '', time() - 3600, '/');
setcookie('idEmpleado', '', time() - 3600, '/');
setcookie('nombre_completo', '', time() - 3600, '/');
session_unset();
session_destroy();
header("Location: ../../index.php");
exit();
?>
