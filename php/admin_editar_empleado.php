<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="card">
        <div class="card-header">
          <span><i class="bi bi-pen me-2"></i></span> Editar Empleado
        </div>
        <div class="card-body">
          <?php 
            include_once '../config/conection.php';
            $conn = conectarDB();
                
            $id = $_GET['id'] ?? null;
                
            if ($id) {
                $sql = "SELECT * FROM empleado WHERE idEmpleado = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $res = $stmt->get_result();
                $empleado = $res->fetch_assoc();
            } else {
                echo "No se ha proporcionado un ID de empleado.";
            }
          ?>
          <h2>Editar Empleado</h2>
          <form action="actualizar_empleado.php" method="post" enctype="multipart/form-data" id="formulario-usuario">        
            <input type="hidden" name="id" value="<?= $empleado['idEmpleado']?>">
            <div class="mb-3">
                <label for="empleado_nombre" class="form-label">Nombre completo</label>
                <input type="text" class="form-control" id="empleado_nombre" name="empleado_nombre" value="<?= $empleado['Nombre_Completo']?>" required>
            </div>
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario" value="<?= $empleado['Usuario']?>" required>
            </div>
            <div id="error-usuario" class="text-danger mb-3"></div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <div class="position-relative">
                <input type="password" class="form-control pe-5 password-input" name="password" value="<?= $empleado['Password']?>" required>
                <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 toggle-password" style="cursor: pointer;"></i>
              </div>
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol</label>
                <select name="rol" id="rol" class="form-select">
                    <option value="ADMIN" <?= $empleado['Rol'] == 'ADMIN' ? 'selected' : '' ?>>ADMIN</option>
                    <option value="EMPLEADO" <?= $empleado['Rol'] == 'EMPLEADO' ? 'selected' : '' ?>>EMPLEADO</option>
                </select>
            </div>
            <button class="btn btn-primary">Actualizar</button>
          </form>
          <script>
            document.querySelectorAll('.toggle-password').forEach(function(icon) {
              icon.addEventListener('click', function () {
                const input = this.previousElementSibling;
                const isPassword = input.type === 'password';
                input.type = isPassword ? 'text' : 'password';
                this.classList.toggle('bi-eye');
                this.classList.toggle('bi-eye-slash');
              });
            });
          </script>
          <script>
            function mostrarFormulario() {
              document.getElementById('container17').style.display = 'block';
              document.getElementById('container1').style.display = 'none';
            }
          
            document.getElementById('formulario-usuario').addEventListener('submit', function (e) {
              e.preventDefault(); // Evitamos el envío por defecto
            
              const usuario = document.getElementById('usuario').value;
              const errorUsuario = document.getElementById('error-usuario');
            
              fetch('validar_usuario.php?usuario=' + encodeURIComponent(usuario))
                .then(response => response.text())
                .then(data => {
                  if (data === 'existe') {
                    errorUsuario.textContent = "Este nombre de usuario ya está en uso.";
                  } else {
                    errorUsuario.textContent = "";
                  
                    // Enviar el formulario manualmente
                    e.target.submit();
                  }
                })
                .catch(error => {
                  console.error('Error en la validación:', error);
                });
            });
          
            window.onload = function () {
              mostrarFormulario(); 
            };
          </script>
        </div>
      </div>
    </div>
  </div>
</div>