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
          <span><i class="bi bi-plus me-2"></i></span> Agregar Tarifa
        </div>
        <div class="card-body">
          <h2>Agregar Tarifa</h2>
          <form method="POST" action="./guardar/guardar_tarifa.php" enctype="multipart/form-data" id="form-tarifa" novalidate>

              <div class="mb-3">
                <label for="modalidad_tarifa" class="form-label">Modalidad</label>
                <input type="text" class="form-control" id="modalidad_tarifa" name="modalidad_tarifa" required>
                <div class="valid-feedback d-none">Modalidad válida.</div>
                <div class="invalid-feedback d-none">Este campo no puede estar vacío.</div>
              </div>

              <div class="mb-3">
                <label for="nro_huespedes_tarifa" class="form-label">Número de Huespedes</label>
                <input type="number" class="form-control" id="nro_huespedes_tarifa" name="nro_huespedes_tarifa" required>
                <div class="valid-feedback d-none">Número válido.</div>
                <div class="invalid-feedback d-none">Debe ser un número mayor que 0.</div>
              </div>

              <div class="mb-3">
                <label for="valor_tarifa" class="form-label">Valor</label>
                <input type="number" class="form-control" id="valor_tarifa" name="valor_tarifa" required>
                <div class="valid-feedback d-none">Valor válido.</div>
                <div class="invalid-feedback d-none">Ingrese un valor positivo.</div>
              </div>

              <div class="mb-3">
                <label for="id_habitacion_tarifa" class="form-label">ID de Habitación</label>
                <input type="number" class="form-control" id="id_habitacion_tarifa" name="id_habitacion_tarifa" required>
                <div class="valid-feedback d-none">ID válido.</div>
                <div class="invalid-feedback d-none">Debe ser un número mayor que 0.</div>
              </div>

              <button type="submit" class="btn btn-primary">Agregar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Script de validación en tiempo real -->
<script>
  const form = document.getElementById('form-tarifa');

  function setValid(input) {
    input.classList.add('is-valid');
    input.classList.remove('is-invalid');
    input.nextElementSibling.classList.replace('d-none', 'd-block'); // valid
    input.nextElementSibling.nextElementSibling.classList.replace('d-block', 'd-none'); // invalid
  }

  function setInvalid(input) {
    input.classList.add('is-invalid');
    input.classList.remove('is-valid');
    input.nextElementSibling.classList.replace('d-block', 'd-none'); // valid
    input.nextElementSibling.nextElementSibling.classList.replace('d-none', 'd-block'); // invalid
  }

  function validarTexto(id) {
    const input = document.getElementById(id);
    if (input.value.trim().length > 0) setValid(input);
    else setInvalid(input);
  }

  function validarNumeroPositivo(id) {
    const input = document.getElementById(id);
    const valor = parseFloat(input.value.trim());
    if (!isNaN(valor) && valor > 0) setValid(input);
    else setInvalid(input);
  }

  document.getElementById('modalidad_tarifa').addEventListener('input', () => validarTexto('modalidad_tarifa'));
  document.getElementById('nro_huespedes_tarifa').addEventListener('input', () => validarNumeroPositivo('nro_huespedes_tarifa'));
  document.getElementById('valor_tarifa').addEventListener('input', () => validarNumeroPositivo('valor_tarifa'));
  document.getElementById('id_habitacion_tarifa').addEventListener('input', () => validarNumeroPositivo('id_habitacion_tarifa'));

  form.addEventListener('submit', function (e) {
    validarTexto('modalidad_tarifa');
    validarNumeroPositivo('nro_huespedes_tarifa');
    validarNumeroPositivo('valor_tarifa');
    validarNumeroPositivo('id_habitacion_tarifa');

    if (!form.checkValidity()) {
      e.preventDefault();
      e.stopPropagation();
    }
  });
</script>
