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

include '../../../config/conection.php'; 

$idEmpleado = $_SESSION['idEmpleado'] ?? null;
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="card">
        <div class="card-header">
          <span><i class="bi bi-plus me-2"></i></span> Agregar Pago
        </div>
        <div class="card-body">
          <h2>Agregar Pago</h2>
          <form method="POST" action="./guardar/guardar_pago.php" enctype="multipart/form-data" id="form-pago" novalidate>

              <div class="mb-3">
                  <label for="fecha_pago" class="form-label">Fecha de Pago</label>
                  <input type="datetime-local" class="form-control" id="fecha_pago" name="fecha_pago" required>
                  <div class="valid-feedback d-none">Fecha válida.</div>
                  <div class="invalid-feedback d-none">La fecha es obligatoria.</div>
              </div>

              <div class="mb-3">
                  <label for="valor_pago" class="form-label">Valor</label>
                  <input type="number" class="form-control" id="valor_pago" name="valor_pago" required>
                  <div class="valid-feedback d-none">Valor válido.</div>
                  <div class="invalid-feedback d-none">Ingrese un número mayor a 0.</div>
              </div>

              <div class="mb-3">
                  <label for="id_huesped_pago" class="form-label">Identificación del Huésped</label>
                  <input type="number" class="form-control" id="id_huesped_pago" name="id_huesped_pago" required>
                  <div class="valid-feedback d-none">ID válido.</div>
                  <div class="invalid-feedback d-none">Debe ser un número positivo.</div>
              </div>

              <div class="mb-3">
                  <label for="id_estadia_pago" class="form-label">ID de Estadía</label>
                  <input type="number" class="form-control" id="id_estadia_pago" name="id_estadia_pago" required>
                  <div class="valid-feedback d-none">ID válido.</div>
                  <div class="invalid-feedback d-none">Debe ser un número positivo.</div>
              </div>

              <input type="hidden" name="id_empleado_pago" value="<?= $idEmpleado ?>">

              <div class="input-group mb-3">
                  <span class="input-group-text">Observación</span>
                  <textarea class="form-control" name="observacion" id="observacion"></textarea>
              </div>

              <div class="mb-3">
                  <label for="imagen" class="form-label">Imagen del pago</label>
                  <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                  <img id="vista-previa" src="#" alt="Vista previa de la imagen" class="img-fluid mt-2 d-none" width="200">
              </div>

              <button type="submit" class="btn btn-primary">Agregar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const form = document.getElementById('form-pago');

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

  function validarCampoFecha(id) {
    const input = document.getElementById(id);
    if (input.value.trim()) setValid(input);
    else setInvalid(input);
  }

  function validarNumeroPositivo(id) {
    const input = document.getElementById(id);
    const valor = parseFloat(input.value.trim());
    if (!isNaN(valor) && valor > 0) setValid(input);
    else setInvalid(input);
  }

  document.getElementById('fecha_pago').addEventListener('input', () => validarCampoFecha('fecha_pago'));
  document.getElementById('valor_pago').addEventListener('input', () => validarNumeroPositivo('valor_pago'));
  document.getElementById('id_huesped_pago').addEventListener('input', () => validarNumeroPositivo('id_huesped_pago'));
  document.getElementById('id_estadia_pago').addEventListener('input', () => validarNumeroPositivo('id_estadia_pago'));

  form.addEventListener('submit', function (e) {
    validarCampoFecha('fecha_pago');
    validarNumeroPositivo('valor_pago');
    validarNumeroPositivo('id_huesped_pago');
    validarNumeroPositivo('id_estadia_pago');

    if (!form.checkValidity()) {
      e.preventDefault();
      e.stopPropagation();
    }
  });

  document.getElementById('imagen').addEventListener('change', function(event) {
    const reader = new FileReader();
    reader.onload = function() {
      const preview = document.getElementById('vista-previa');
      preview.src = reader.result;
      preview.classList.remove('d-none');
    }
    reader.readAsDataURL(event.target.files[0]);
  });
</script>
