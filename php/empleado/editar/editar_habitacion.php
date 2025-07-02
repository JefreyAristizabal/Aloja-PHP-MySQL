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
          <span><i class="bi bi-pen me-2"></i></span> Editar Habitación
        </div>
        <div class="card-body">
          <?php 
            include_once '../../../config/conection.php';
            $conn = conectarDB();

            $id = $_GET['id'] ?? null;

            if ($id) {
                $sql = "SELECT * FROM HABITACION WHERE idHABITACION = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $res = $stmt->get_result();
                $habitacion = $res->fetch_assoc();
            } else {
                echo "No se ha proporcionado un ID de habitación.";
            }
          ?>
          <h2>Editar Habitación</h2>
          <form action="./actualizar/actualizar_habitacion.php" method="post" enctype="multipart/form-data" id="form-habitacion" novalidate>        
            <input type="hidden" name="id" value="<?= $habitacion['idHABITACION']?>">

            <!-- Nombre -->
            <div class="mb-3">
              <label for="nombre_habitacion" class="form-label">Nombre de habitación</label>
              <input class="form-control" type="text" name="nombre_habitacion" id="nombre_habitacion" value="<?= $habitacion['NOMBRE'] ?>" required>
              <div class="valid-feedback d-none">Nombre válido.</div>
              <div class="invalid-feedback d-none">Debe tener al menos 3 caracteres.</div>
            </div>

            <!-- Capacidad -->
            <div class="mb-3">
              <label for="capacidad" class="form-label">Capacidad</label>
              <input class="form-control" type="number" name="capacidad" id="capacidad" value="<?= $habitacion['CAPACIDAD'] ?>" min="1" max="20" required>
              <div class="valid-feedback d-none">Capacidad válida.</div>
              <div class="invalid-feedback d-none">Debe ser un número entre 1 y 20.</div>
            </div>

            <!-- Descripción -->
            <div class="mb-3">
              <label for="descripcion_habitacion" class="form-label">Descripción</label>
              <input type="text" class="form-control" id="descripcion_habitacion" name="descripcion_habitacion" value="<?= $habitacion['DESCRIPCION'] ?>" required>
              <div class="valid-feedback d-none">Descripción válida.</div>
              <div class="invalid-feedback d-none">Debe tener al menos 10 caracteres.</div>
            </div>

            <!-- Imagen -->
            <div class="mb-3">
              <label for="imagen" class="form-label">Imagen actual:</label><br>
              <img src="<?= $habitacion['IMAGEN']?>" width="200" alt="habitacion" class="mb-2"><br>
              <label for="imagen" class="form-label">Cambiar imagen (opcional)</label>
              <input type="file" class="form-control" name="imagen" id="imagen" accept="image/*">
            </div>

            <button class="btn btn-primary">Actualizar</button>
          </form>

          <!-- Validación JS en tiempo real -->
          <script>
            const form = document.getElementById('form-habitacion');
            const nombre = document.getElementById('nombre_habitacion');
            const capacidad = document.getElementById('capacidad');
            const descripcion = document.getElementById('descripcion_habitacion');

            const validarCampo = (input, condicion) => {
              const valid = input.nextElementSibling;
              const invalid = valid.nextElementSibling;
              if (condicion) {
                input.classList.add('is-valid');
                input.classList.remove('is-invalid');
                valid.classList.remove('d-none');
                valid.classList.add('d-block');
                invalid.classList.remove('d-block');
                invalid.classList.add('d-none');
              } else {
                input.classList.add('is-invalid');
                input.classList.remove('is-valid');
                invalid.classList.remove('d-none');
                invalid.classList.add('d-block');
                valid.classList.remove('d-block');
                valid.classList.add('d-none');
              }
            };

            nombre.addEventListener('input', () => {
              validarCampo(nombre, nombre.value.trim().length >= 3);
            });

            capacidad.addEventListener('input', () => {
              const cap = parseInt(capacidad.value);
              validarCampo(capacidad, cap >= 1 && cap <= 20);
            });

            descripcion.addEventListener('input', () => {
              validarCampo(descripcion, descripcion.value.trim().length >= 10);
            });

            form.addEventListener('submit', (e) => {
              const valido =
                nombre.value.trim().length >= 3 &&
                parseInt(capacidad.value) >= 1 &&
                parseInt(capacidad.value) <= 20 &&
                descripcion.value.trim().length >= 10;

              if (!valido) {
                e.preventDefault();
              }

              form.classList.add('was-validated');
            });
          </script>
        </div>
      </div>
    </div>
  </div>
</div>
