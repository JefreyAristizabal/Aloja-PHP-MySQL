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
          <span><i class="bi bi-plus me-2"></i></span> Agregar Novedad
        </div>
        <div class="card-body">
          <h2>Agregar Novedad</h2>
          <form method="POST" action="./guardar/guardar_novedad.php" enctype="multipart/form-data" id="form-novedad" novalidate>

            <!-- Descripción -->
            <div class="input-group mb-3">
              <span class="input-group-text">Descripción</span>
              <textarea class="form-control" name="descripcion_novedad" id="descripcion_novedad" required></textarea>
            </div>
            <div class="ms-1">
              <div class="valid-feedback d-none">Descripción válida.</div>
              <div class="invalid-feedback d-none">La descripción no puede estar vacía.</div>
            </div>

            <!-- ID de estadía -->
            <div class="mb-3">
              <label for="id_estadia_novedad" class="form-label">ID de Estadía</label>
              <input type="number" class="form-control" id="id_estadia_novedad" name="id_estadia_novedad" required>
              <div class="valid-feedback d-none">ID válido.</div>
              <div class="invalid-feedback d-none">Debe ser un número positivo.</div>
            </div>

            <button type="submit" class="btn btn-primary">Agregar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Script de validación -->
<script>
  const form = document.getElementById('form-novedad');

  function validarTexto(id) {
    const input = document.getElementById(id);
    if (input.value.trim().length > 0) {
      setValido(input);
    } else {
      setInvalido(input);
    }
  }

  function validarNumero(id) {
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
    const valid = input.parentNode.querySelector('.valid-feedback');
    const invalid = input.parentNode.querySelector('.invalid-feedback');
    if (valid) valid.classList.replace('d-none', 'd-block');
    if (invalid) invalid.classList.replace('d-block', 'd-none');
  }

  function setInvalido(input) {
    input.classList.add('is-invalid');
    input.classList.remove('is-valid');
    const valid = input.parentNode.querySelector('.valid-feedback');
    const invalid = input.parentNode.querySelector('.invalid-feedback');
    if (valid) valid.classList.replace('d-block', 'd-none');
    if (invalid) invalid.classList.replace('d-none', 'd-block');
  }

  document.getElementById('descripcion_novedad').addEventListener('input', () => validarTexto('descripcion_novedad'));
  document.getElementById('id_estadia_novedad').addEventListener('input', () => validarNumero('id_estadia_novedad'));

  form.addEventListener('submit', function (e) {
    validarTexto('descripcion_novedad');
    validarNumero('id_estadia_novedad');

    if (!form.checkValidity()) {
      e.preventDefault();
      e.stopPropagation();
    }
  });
</script>
