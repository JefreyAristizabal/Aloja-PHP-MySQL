<?php
session_start();

if (!isset($_SESSION['logged_in']) || isset($_COOKIE['logged_in']) && $_COOKIE['logged_in']) {
    $_SESSION['usuario'] = $_COOKIE['usuario'] ?? '';
    $_SESSION['rol'] = $_COOKIE['rol'] ?? '';
    $_SESSION['logged_in'] = true;
    $_SESSION['idEmpleado'] = $_COOKIE['idEmpleado'] ?? '';
    $_SESSION['nombre_completo'] = $_COOKIE['nombre_completo'] ?? '';
}

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] || $_SESSION['rol'] !== 'ADMIN') {
  header("Location: ../../../html/log-in.html");
  exit();
}
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="card">
        <div class="card-header">
          <span><i class="bi bi-plus me-2"></i></span> Agregar Empleado
        </div>
        <div class="card-body">
          <h2>Agregar Empleados</h2>
          <form method="POST" action="./guardar/guardar_empleado.php" id="formulario-usuario" enctype="multipart/form-data" novalidate>
            <div class="mb-3">
              <label for="empleado_nombre" class="form-label">Nombre completo</label>
              <input type="text" class="form-control" id="empleado_nombre" name="empleado_nombre" required>
              <div class="valid-feedback">Nombre válido.</div>
              <div class="invalid-feedback">Debe tener al menos 3 caracteres.</div>
            </div>

            <div class="mb-3">
              <label for="usuario" class="form-label">Usuario</label>
              <input type="text" class="form-control" id="usuario" name="usuario" required>
              <div class="valid-feedback">Usuario válido.</div>
              <div class="invalid-feedback">Mínimo 4 caracteres alfanuméricos.</div>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Contraseña</label>

              <!-- Contenedor solo para input e ícono -->
              <div class="position-relative">
                <input type="password" class="form-control pe-5" id="password" name="password" required>
                <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 px-4" id="togglePassword" style="cursor: pointer;"></i>
              </div>

              <!-- Feedback fuera del input wrapper -->
              <div id="passwordValid" class="valid-feedback d-none">Contraseña válida.</div>
              <div id="passwordInvalid" class="invalid-feedback d-none">Mínimo 6 caracteres y un número.</div>
            </div>


            <div class="mb-3">
              <label for="rol" class="form-label">Rol</label>
              <select name="rol" id="rol" class="form-select" required>
                <option value="ADMIN">ADMIN</option>
                <option value="EMPLEADO" selected>EMPLEADO</option>
              </select>
              <div class="valid-feedback">Rol seleccionado.</div>
              <div class="invalid-feedback">Seleccione un rol válido.</div>
            </div>

            <button type="submit" class="btn btn-primary">Agregar</button>
          </form>

          <!-- Script de validación en tiempo real -->
          <script>
            const form = document.getElementById('formulario-usuario');

            // Inputs
            const nombre = document.getElementById('empleado_nombre');
            const usuario = document.getElementById('usuario');
            const password = document.getElementById('password');
            const rol = document.getElementById('rol');
            const passwordValid = document.getElementById('passwordValid');
            const passwordInvalid = document.getElementById('passwordInvalid');

            const validarInput = (input, condicion) => {
              if (condicion) {
                input.classList.add('is-valid');
                input.classList.remove('is-invalid');
              } else {
                input.classList.add('is-invalid');
                input.classList.remove('is-valid');
              }
            };

            nombre.addEventListener('input', () => {
              validarInput(nombre, nombre.value.trim().length >= 3);
            });

            usuario.addEventListener('input', () => {
              const regex = /^[a-zA-Z0-9]{4,}$/;
              validarInput(usuario, regex.test(usuario.value.trim()));
            });

            const validarPassword = (valor) => {
              const tieneLetra = /[A-Za-z]/.test(valor);
              const tieneNumero = /\d/.test(valor);
              return valor.length >= 6 && tieneLetra && tieneNumero;
            };
          
            password.addEventListener('input', () => {
              const esValida = validarPassword(password.value.trim());
            
              if (esValida) {
                password.classList.add('is-valid');
                password.classList.remove('is-invalid');
              
                passwordValid.classList.remove('d-none');
                passwordValid.classList.add('d-block');
                passwordInvalid.classList.remove('d-block');
                passwordInvalid.classList.add('d-none');
              } else {
                password.classList.add('is-invalid');
                password.classList.remove('is-valid');
              
                passwordInvalid.classList.remove('d-none');
                passwordInvalid.classList.add('d-block');
                passwordValid.classList.remove('d-block');
                passwordValid.classList.add('d-none');
              }
            });

            rol.addEventListener('change', () => {
              validarInput(rol, rol.value !== '');
            });

            // Mostrar feedback si el usuario intenta enviar sin llenar correctamente
            form.addEventListener('submit', (e) => {
              if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
              }
              form.classList.add('was-validated');
            });

            // Toggle de visibilidad de la contraseña
            const togglePassword = document.getElementById('togglePassword');
            togglePassword.addEventListener('click', function () {
              const isPassword = password.type === "password";
              password.type = isPassword ? "text" : "password";
              this.classList.toggle("bi-eye");
              this.classList.toggle("bi-eye-slash");
            });
          </script>
        </div>
      </div>
    </div>
  </div>
</div>
