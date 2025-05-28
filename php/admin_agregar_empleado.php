<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="card">
        <div class="card-header">
          <span><i class="bi bi-plus me-2"></i></span> Agregar Empleado
        </div>
        <div class="card-body">
          <h2>Agregar Empleados</h2>
          <form method="POST" action="guardar_empleado.php" id="formulario-usuario" enctype="multipart/form-data">
              <div class="mb-3">
                  <label for="empleado_nombre" class="form-label">Nombre completo</label>
                  <input type="text" class="form-control" id="empleado_nombre" name="empleado_nombre" required>
              </div>
              <div class="mb-3">
                  <label for="usuario" class="form-label">Usuario</label>
                  <input type="text" class="form-control" id="usuario" name="usuario" required>
              </div>
              <div id="error-usuario" class="text-danger mb-3"></div>
              <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <div class="position-relative">
                    <input type="password" class="form-control pe-5" id="password" name="password" required>
                    <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3" id="togglePassword" style="cursor: pointer;"></i>
                  </div>
              </div>
              <div class="mb-3">
                  <label for="rol" class="form-label">Rol</label>
                  <select name="rol" id="rol" class="form-select">
                      <option value="ADMIN">ADMIN</option>
                      <option value="EMPLEADO" selected>EMPLEADO</option>
                  </select>
              </div>
              <button type="submit" class="btn btn-primary">Agregar</button>
          </form>
          <script>
            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');
                  
            togglePassword.addEventListener('click', function () {
              const isPassword = password.type === "password";
              password.type = isPassword ? "text" : "password";
              this.classList.toggle("bi-eye");
              this.classList.toggle("bi-eye-slash");
            });
          </script>
          <script>
            function mostrarFormulario() {
              document.getElementById('container11').style.display = 'block';
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