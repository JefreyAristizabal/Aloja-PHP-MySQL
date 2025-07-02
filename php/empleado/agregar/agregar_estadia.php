<?php
session_start();

if (!isset($_SESSION['logged_in']) || isset($_COOKIE['logged_in']) && $_COOKIE['logged_in']) {
    $_SESSION['usuario'] = $_COOKIE['usuario'] ?? '';
    $_SESSION['rol'] = $_COOKIE['rol'] ?? '';
    $_SESSION['logged_in'] = true;
    $_SESSION['idEmpleado'] = $_COOKIE['idEmpleado'] ?? '';
    $_SESSION['nombre_completo'] = $_COOKIE['nombre_completo'] ?? '';
}

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] || $_SESSION['rol'] !== 'EMPLEADO') {
  header("Location: ../../../html/log-in.html");
  exit();
}
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="card">
        <div class="card-header">
          <span><i class="bi bi-plus me-2"></i></span> Agregar Estadía
        </div>
        <div class="card-body">
          <h2>Agregar Estadía</h2>
          <form action="./guardar/guardar_estadia.php" method="POST" enctype="multipart/form-data" id="formulario-estadia">
            
            <!-- Fecha Inicio -->
            <div class="mb-3">
              <label for="fechaInicio_estadia" class="form-label">Fecha de inicio</label>
              <input type="date" class="form-control" id="fechaInicio_estadia" name="fechaInicio_estadia" required>
              <div class="valid-feedback d-none">Fecha válida.</div>
              <div class="invalid-feedback d-none">La fecha de inicio debe ser hoy o posterior y menor que la de fin.</div>
            </div>

            <!-- Fecha Fin -->
            <div class="mb-3">
              <label for="fechaFin_estadia" class="form-label">Fecha de fin</label>
              <input type="date" class="form-control" id="fechaFin_estadia" name="fechaFin_estadia" required>
              <div class="valid-feedback d-none">Fecha válida.</div>
              <div class="invalid-feedback d-none">La fecha de fin debe ser mayor que la de inicio.</div>
            </div>

            <!-- Costo -->
            <div class="mb-3">
              <label for="costo_estadia" class="form-label">Costo</label>
              <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" class="form-control" id="costo_estadia" name="costo_estadia" required>
              </div>
              <div class="valid-feedback d-none">Costo válido.</div>
              <div class="invalid-feedback d-none">El costo debe ser mayor a 0.</div>
            </div>

            <!-- ID habitación -->
            <div class="mb-3">
              <label for="id_habitacion_estadia" class="form-label">ID de Habitación</label>
              <input type="number" name="id_habitacion_estadia" id="id_habitacion_estadia" class="form-control" required>
              <div class="valid-feedback d-none">ID válido.</div>
              <div class="invalid-feedback d-none">Debe ingresar un ID mayor a 0.</div>
            </div>

            <div id="error" class="text-danger mb-3"></div>
            <button type="submit" class="btn btn-primary mb-2">Guardar</button>
          </form>

          <!-- Validación JS -->
          <script>
            const form = document.getElementById('formulario-estadia');

            const inicioInput = document.getElementById('fechaInicio_estadia');
            const finInput = document.getElementById('fechaFin_estadia');
            const costoInput = document.getElementById('costo_estadia');
            const habitacionInput = document.getElementById('id_habitacion_estadia');

            function validarFechaInicio() {
              const hoy = new Date();
              hoy.setHours(0, 0, 0, 0);
              const inicio = new Date(inicioInput.value);
              const fin = new Date(finInput.value);

              if (inicio >= hoy && (!finInput.value || inicio < fin)) {
                setValido(inicioInput);
              } else {
                setInvalido(inicioInput);
              }
            }

            function validarFechaFin() {
              const inicio = new Date(inicioInput.value);
              const fin = new Date(finInput.value);

              if (fin > inicio) {
                setValido(finInput);
              } else {
                setInvalido(finInput);
              }
            }

            function validarCosto() {
              const costo = parseFloat(costoInput.value);
              if (!isNaN(costo) && costo > 0) {
                setValido(costoInput);
              } else {
                setInvalido(costoInput);
              }
            }

            function validarHabitacion() {
              const id = parseInt(habitacionInput.value);
              if (!isNaN(id) && id > 0) {
                setValido(habitacionInput);
              } else {
                setInvalido(habitacionInput);
              }
            }

            // Funciones auxiliares para aplicar clases Bootstrap
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

            // Eventos en tiempo real
            inicioInput.addEventListener('input', () => {
              validarFechaInicio();
              validarFechaFin(); // por si fin ya fue escrito
            });

            finInput.addEventListener('input', () => {
              validarFechaInicio(); // por si cambió
              validarFechaFin();
            });

            costoInput.addEventListener('input', validarCosto);
            habitacionInput.addEventListener('input', validarHabitacion);

            // Validar al enviar
            form.addEventListener('submit', (e) => {
              validarFechaInicio();
              validarFechaFin();
              validarCosto();
              validarHabitacion();

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
