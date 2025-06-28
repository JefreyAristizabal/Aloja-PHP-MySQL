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
          <span><i class="bi bi-pen me-2"></i></span> Editar Tarifa
        </div>
        <div class="card-body">
          <?php 
            include_once '../../../config/conection.php';
            $conn = conectarDB();

            $id = $_GET['id'] ?? null;

            if ($id) {
              $sql = "SELECT * FROM tarifa WHERE idTarifa = ?";
              $stmt = $conn->prepare($sql);
              $stmt->bind_param("i", $id);
              $stmt->execute();
              $res = $stmt->get_result();
              $tarifa = $res->fetch_assoc();
            } else {
              echo "No se ha proporcionado un ID de tarifa.";
              exit();
            }
          ?>
          <h2>Editar Tarifa</h2>
          <form action="./actualizar/actualizar_tarifa.php" method="post" id="form-tarifa" novalidate>
            <input type="hidden" name="id" value="<?= $tarifa['idTarifa']?>">

            <div class="mb-3">
              <label for="modalidad_tarifa" class="form-label">Modalidad</label>
              <input type="text" class="form-control" id="modalidad_tarifa" name="modalidad_tarifa" value="<?= $tarifa['Modalidad']?>" required>
              <div class="valid-feedback d-none">Modalidad válida.</div>
              <div class="invalid-feedback d-none">Debe tener al menos 3 caracteres.</div>
            </div>

            <div class="mb-3">
              <label for="nro_huespedes_tarifa" class="form-label">Número de Huéspedes</label>
              <input type="number" class="form-control" id="nro_huespedes_tarifa" name="nro_huespedes_tarifa" value="<?= $tarifa['NroHuespedes']?>" required>
              <div class="valid-feedback d-none">Número válido.</div>
              <div class="invalid-feedback d-none">Debe ser un número mayor a 0.</div>
            </div>

            <div class="mb-3">
              <label for="valor_tarifa" class="form-label">Valor</label>
              <input type="number" class="form-control" id="valor_tarifa" name="valor_tarifa" value="<?= $tarifa['Valor']?>" required>
              <div class="valid-feedback d-none">Valor válido.</div>
              <div class="invalid-feedback d-none">Debe ser mayor que 0.</div>
            </div>

            <div class="mb-3">
              <label for="id_habitacion_tarifa" class="form-label">ID de Habitación</label>
              <input type="number" class="form-control" id="id_habitacion_tarifa" name="id_habitacion_tarifa" value="<?= $tarifa['Habitacion_idHabitacion']?>" required>
              <div class="valid-feedback d-none">ID válido.</div>
              <div class="invalid-feedback d-none">Debe ser mayor que 0.</div>
            </div>

            <button class="btn btn-primary">Actualizar</button>
          </form>

          <!-- Validación en tiempo real -->
          <script>
            const form = document.getElementById('form-tarifa');
            const modalidad = document.getElementById('modalidad_tarifa');
            const nroHuespedes = document.getElementById('nro_huespedes_tarifa');
            const valor = document.getElementById('valor_tarifa');
            const idHabitacion = document.getElementById('id_habitacion_tarifa');

            const validar = (input, condicion) => {
              const valid = input.nextElementSibling;
              const invalid = valid.nextElementSibling;
              if (condicion) {
                input.classList.add('is-valid');
                input.classList.remove('is-invalid');
                valid.classList.remove('d-none'); valid.classList.add('d-block');
                invalid.classList.remove('d-block'); invalid.classList.add('d-none');
              } else {
                input.classList.add('is-invalid');
                input.classList.remove('is-valid');
                invalid.classList.remove('d-none'); invalid.classList.add('d-block');
                valid.classList.remove('d-block'); valid.classList.add('d-none');
              }
            };

            modalidad.addEventListener('input', () => {
              validar(modalidad, modalidad.value.trim().length >= 3);
            });

            nroHuespedes.addEventListener('input', () => {
              validar(nroHuespedes, parseInt(nroHuespedes.value) > 0);
            });

            valor.addEventListener('input', () => {
              validar(valor, parseFloat(valor.value) > 0);
            });

            idHabitacion.addEventListener('input', () => {
              validar(idHabitacion, parseInt(idHabitacion.value) > 0);
            });

            form.addEventListener('submit', (e) => {
              const condiciones = [
                modalidad.value.trim().length >= 3,
                parseInt(nroHuespedes.value) > 0,
                parseFloat(valor.value) > 0,
                parseInt(idHabitacion.value) > 0
              ];

              if (condiciones.includes(false)) {
                e.preventDefault();
                e.stopPropagation();
                form.classList.add('was-validated');
              }
            });
          </script>
        </div>
      </div>
    </div>
  </div>
</div>
