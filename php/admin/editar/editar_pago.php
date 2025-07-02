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
          <span><i class="bi bi-pen me-2"></i></span> Editar Pago
        </div>
        <div class="card-body">
          <?php 
            include_once '../../../config/conection.php';
            $conn = conectarDB();
                
            $id = $_GET['id'] ?? null;
                
            if ($id) {
                $sql = "SELECT * FROM pagos WHERE idPagos = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $res = $stmt->get_result();
                $pago = $res->fetch_assoc();
                $sql_huesped = "SELECT numero_documento FROM huesped WHERE idHUESPED = " . $pago['HUESPED_idHUESPED'];
                $resultado_huesped = $conn->query($sql_huesped);
                $huesped = $resultado_huesped->fetch_assoc();
            } else {
                echo "No se ha proporcionado un ID de pago.";
                return;
            }
          ?>
          <h2>Editar Pago</h2>
          <form action="./actualizar/actualizar_pago.php" method="post" enctype="multipart/form-data" id="form-pago" novalidate>        
            <input type="hidden" name="id" value="<?= $pago['idPagos'] ?>">

            <!-- Fecha -->
            <div class="mb-3">
              <label for="fecha_pago" class="form-label">Fecha de Pago</label>
              <input type="datetime-local" class="form-control" id="fecha_pago" name="fecha_pago" value="<?= $pago['Fecha_Pago'] ?>" required>
              <div class="valid-feedback d-none">Fecha válida.</div>
              <div class="invalid-feedback d-none">Debe seleccionar una fecha.</div>
            </div>

            <!-- Valor -->
            <div class="mb-3">
              <label for="valor_pago" class="form-label">Valor</label>
              <input type="number" class="form-control" id="valor_pago" name="valor_pago" value="<?= $pago['Valor'] ?>" required>
              <div class="valid-feedback d-none">Valor válido.</div>
              <div class="invalid-feedback d-none">Debe ser mayor que 0.</div>
            </div>

            <!-- Huesped -->
            <div class="mb-3">
              <label for="id_huesped_pago" class="form-label">Identificación del Huésped</label>
              <input type="number" class="form-control" id="id_huesped_pago" name="id_huesped_pago" value="<?= $huesped['numero_documento'] ?>" required>
              <div class="valid-feedback d-none">Documento válido.</div>
              <div class="invalid-feedback d-none">Debe tener entre 6 y 15 dígitos.</div>
            </div>

            <!-- Estadía -->
            <div class="mb-3">
              <label for="id_estadia_pago" class="form-label">ID de Estadía</label>
              <input type="number" class="form-control" id="id_estadia_pago" name="id_estadia_pago" value="<?= $pago['Estadia_idEstadia'] ?>" required>
              <div class="valid-feedback d-none">ID válido.</div>
              <div class="invalid-feedback d-none">Debe ser un número mayor que 0.</div>
            </div>

            <input type="hidden" name="id_empleado_pago" value="<?= $pago['Empleado_idEmpleado'] ?>">

            <!-- Observación -->
            <div class="mb-3">
              <label for="observacion" class="form-label">Observación</label>
              <textarea class="form-control" id="observacion" name="observacion"><?= $pago['Observacion'] ?></textarea>
            </div>

            <!-- Imagen -->
            <div class="mb-3">
              <label class="form-label">Imagen Actual:</label><br>
              <img src="<?= $pago['Imagen'] ?>" width="200" alt="pago"><br><br>
              <label for="imagen" class="form-label">Cambiar imagen (opcional)</label>
              <input type="file" class="form-control" name="imagen" id="imagen" accept="image/*">
              <div class="invalid-feedback d-none">Solo se aceptan imágenes válidas (jpg, png, etc).</div>
            </div>

            <button class="btn btn-primary">Actualizar</button>
          </form>

          <!-- Script de validación -->
          <script>
            const form = document.getElementById('form-pago');
            const fecha = document.getElementById('fecha_pago');
            const valor = document.getElementById('valor_pago');
            const huesped = document.getElementById('id_huesped_pago');
            const estadia = document.getElementById('id_estadia_pago');
            const imagen = document.getElementById('imagen');

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

            fecha.addEventListener('input', () => {
              validar(fecha, fecha.value.trim() !== "");
            });

            valor.addEventListener('input', () => {
              validar(valor, parseFloat(valor.value) > 0);
            });

            huesped.addEventListener('input', () => {
              validar(huesped, /^\d{6,15}$/.test(huesped.value.trim()));
            });

            estadia.addEventListener('input', () => {
              validar(estadia, parseInt(estadia.value) > 0);
            });

            imagen.addEventListener('change', () => {
              const file = imagen.files[0];
              if (!file) return;

              const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
              const isValid = validTypes.includes(file.type);
              if (!isValid) {
                imagen.classList.add('is-invalid');
                imagen.nextElementSibling.classList.remove('d-none');
              } else {
                imagen.classList.remove('is-invalid');
                imagen.nextElementSibling.classList.add('d-none');
              }
            });

            form.addEventListener('submit', (e) => {
              const condiciones = [
                fecha.value.trim() !== "",
                parseFloat(valor.value) > 0,
                /^\d{6,15}$/.test(huesped.value.trim()),
                parseInt(estadia.value) > 0
              ];

              if (condiciones.includes(false)) {
                e.preventDefault();
                form.classList.add('was-validated');
              }
            });
          </script>
        </div>
      </div>
    </div>
  </div>
</div>
