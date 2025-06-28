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
          <span><i class="bi bi-plus me-2"></i></span> Agregar Huésped x Estadía
        </div>
        <div class="card-body">
          <h2>Agregar Huésped x Estadía</h2>
          <form action="./guardar/guardar_huespedxestadia.php" method="POST" enctype="multipart/form-data" id="formulario-estadia" novalidate>

            <!-- ID Huesped -->
            <div class="mb-3">
              <label for="id_huesped" class="form-label">Identificación del Huésped</label>
              <input type="number" class="form-control" id="id_huesped" name="id_huesped" required>
              <div class="valid-feedback d-none">ID válido.</div>
              <div class="invalid-feedback d-none">Este campo es obligatorio y debe ser un número positivo.</div>
            </div>

            <!-- ID Estadía -->
            <div class="mb-3">
              <label for="id_estadia" class="form-label">ID de Estadía</label>
              <input type="number" class="form-control" id="id_estadia" name="id_estadia" required>
              <div class="valid-feedback d-none">ID válido.</div>
              <div class="invalid-feedback d-none">Este campo es obligatorio y debe ser un número positivo.</div>
            </div>

            <button type="submit" class="btn btn-primary mb-2">Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- JS de validación -->
<script>
  const form = document.getElementById('formulario-estadia');

  function validarNumeroPositivo(id) {
    const input = document.getElementById(id);
    const valor = parseInt(input.value.trim());
    if (!isNaN(valor) && valor > 0) {
      setValido(input);
    } else {
      setInvalido(input);
    }
  }

  function setValido(input) {
    input.classList.add('is-valid');
    input.classList.remove('is-invalid');
    const valid = input.nextElementSibling;
    const invalid = valid?.nextElementSibling;
    if (valid) valid.classList.replace('d-none', 'd-block');
    if (invalid) invalid.classList.replace('d-block', 'd-none');
  }

  function setInvalido(input) {
    input.classList.add('is-invalid');
    input.classList.remove('is-valid');
    const valid = input.nextElementSibling;
    const invalid = valid?.nextElementSibling;
    if (valid) valid.classList.replace('d-block', 'd-none');
    if (invalid) invalid.classList.replace('d-none', 'd-block');
  }

  // Validación en tiempo real
  document.getElementById('id_huesped').addEventListener('input', () => validarNumeroPositivo('id_huesped'));
  document.getElementById('id_estadia').addEventListener('input', () => validarNumeroPositivo('id_estadia'));

  // Validación en submit
  form.addEventListener('submit', function (e) {
    validarNumeroPositivo('id_huesped');
    validarNumeroPositivo('id_estadia');

    if (!form.checkValidity()) {
      e.preventDefault();
      e.stopPropagation();
    }
  });
</script>
