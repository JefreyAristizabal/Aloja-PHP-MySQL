<?php
session_start();

if (!isset($_SESSION['logged_in']) && isset($_COOKIE['logged_in']) && $_COOKIE['logged_in']) {
    $_SESSION['usuario'] = $_COOKIE['usuario'] ?? '';
    $_SESSION['rol'] = $_COOKIE['rol'] ?? '';
    $_SESSION['logged_in'] = true;
    $_SESSION['idEmpleado'] = $_COOKIE['idEmpleado'] ?? '';
    $_SESSION['nombre_completo'] = $_COOKIE['nombre_completo'] ?? '';
}

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] || $_SESSION['rol'] !== 'ADMIN') {
  header("Location: ../html/log-in.html");
  exit();
}
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="card">
        <div class="card-header">
          <span><i class="bi bi-plus me-2"></i></span> Agregar Habitación
        </div>
        <div class="card-body">
          <h2>Agregar Habitación</h2>
          <form action="./guardar/guardar_habitacion.php" method="POST" enctype="multipart/form-data" id="formulario-habitacion">

            <!-- Nombre de habitación -->
            <div class="mb-3">
              <label for="nombre_habitacion" class="form-label">Nombre de la Habitación</label>
              <input type="text" class="form-control" id="nombre_habitacion" name="nombre_habitacion" required>
              <div class="valid-feedback d-none">Nombre válido.</div>
              <div class="invalid-feedback d-none">Este campo es obligatorio.</div>
            </div>

            <!-- Capacidad -->
            <div class="mb-3">
              <label for="capacidad" class="form-label">Capacidad</label>
              <input type="number" class="form-control" id="capacidad" name="capacidad" min="1" max="10" required>
              <div class="valid-feedback d-none">Capacidad válida.</div>
              <div class="invalid-feedback d-none">Debe ser un número entre 1 y 10.</div>
            </div>

            <!-- Descripción -->
            <div class="mb-3">
              <label for="descripcion_habitacion" class="form-label">Descripción</label>
              <input type="text" class="form-control" id="descripcion_habitacion" name="descripcion_habitacion" required>
              <div class="valid-feedback d-none">Descripción válida.</div>
              <div class="invalid-feedback d-none">Este campo es obligatorio.</div>
            </div>

            <!-- Imagen -->
            <div class="mb-3">
              <label for="imagen" class="form-label">Imagen de la Habitación</label>
              <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
              <div class="valid-feedback d-none">Imagen válida.</div>
              <div class="invalid-feedback d-none">Debe subir una imagen válida.</div>
              <br>
              <img id="vista-previa" src="#" alt="Vista previa de la imagen" class="img-fluid mt-2 d-none" width="200">
            </div>

            <button type="submit" class="btn btn-primary mb-2">Guardar</button>

          </form>

          <!-- Scripts -->
          <script>
            const form = document.getElementById('formulario-habitacion');

            const nombre = document.getElementById('nombre_habitacion');
            const capacidad = document.getElementById('capacidad');
            const descripcion = document.getElementById('descripcion_habitacion');
            const imagen = document.getElementById('imagen');

            // Imagen Preview
            imagen.addEventListener('change', function (event) {
              const file = event.target.files[0];
              const preview = document.getElementById('vista-previa');

              if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function () {
                  preview.src = reader.result;
                  preview.classList.remove('d-none');
                };
                reader.readAsDataURL(file);
              } else {
                preview.classList.add('d-none');
              }

              validarImagen();
            });

            nombre.addEventListener('input', () => {
              validarCampoTexto(nombre);
            });

            capacidad.addEventListener('input', () => {
              const val = parseInt(capacidad.value);
              if (val >= 1 && val <= 10) {
                setValido(capacidad);
              } else {
                setInvalido(capacidad);
              }
            });

            descripcion.addEventListener('input', () => {
              validarCampoTexto(descripcion);
            });

            function validarCampoTexto(input) {
              if (input.value.trim().length > 0) {
                setValido(input);
              } else {
                setInvalido(input);
              }
            }

            function validarImagen() {
              const file = imagen.files[0];
              if (file && file.type.startsWith('image/')) {
                setValido(imagen);
              } else {
                setInvalido(imagen);
              }
            }

            function setValido(input) {
              input.classList.add('is-valid');
              input.classList.remove('is-invalid');
              mostrarFeedback(input, true);
            }

            function setInvalido(input) {
              input.classList.add('is-invalid');
              input.classList.remove('is-valid');
              mostrarFeedback(input, false);
            }

            function mostrarFeedback(input, valido) {
              const container = input.closest('.mb-3');
              const valid = container.querySelector('.valid-feedback');
              const invalid = container.querySelector('.invalid-feedback');

              if (valido) {
                valid.classList.remove('d-none');
                valid.classList.add('d-block');
                invalid.classList.remove('d-block');
                invalid.classList.add('d-none');
              } else {
                invalid.classList.remove('d-none');
                invalid.classList.add('d-block');
                valid.classList.remove('d-block');
                valid.classList.add('d-none');
              }
            }

            // Validar al enviar
            form.addEventListener('submit', (e) => {
              validarCampoTexto(nombre);
              validarCampoTexto(descripcion);
              validarImagen();

              const cap = parseInt(capacidad.value);
              if (isNaN(cap) || cap < 1 || cap > 10) {
                setInvalido(capacidad);
              }

              if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
              }

              form.classList.add('was-validated');
            });
          </script>
        </div>
      </div>
    </div>
  </div>
</div>
