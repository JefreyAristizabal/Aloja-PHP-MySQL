<?php
session_start();

if (!isset($_SESSION['logged_in']) && isset($_COOKIE['logged_in']) && $_COOKIE['logged_in']) {
    $_SESSION['usuario'] = $_COOKIE['usuario'] ?? '';
    $_SESSION['rol'] = $_COOKIE['rol'] ?? '';
    $_SESSION['logged_in'] = true;
    $_SESSION['idEmpleado'] = $_COOKIE['idEmpleado'] ?? '';
    $_SESSION['nombre_completo'] = $_COOKIE['nombre_completo'] ?? '';
}

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] || $_SESSION['rol'] !== 'EMPLEADO') {
  header("Location: ../html/log-in.html");
  exit();
}
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="card">
        <div class="card-header">
          <span><i class="bi bi-pen me-2"></i></span> Editar Huésped x Estadía
        </div>
        <div class="card-body">
          <?php 
            include_once '../../../config/conection.php';
            $conn = conectarDB();

            $idhuesped = $_GET['idhuesped'] ?? null;
            $idestadia = $_GET['idestadia'] ?? null;

            if ($idhuesped && $idestadia) {
                $sql = "SELECT * FROM huesped_has_estadia WHERE HUESPED_idHUESPED = ? AND Estadia_idEstadia = ?";
                $huespedes = $conn->query("SELECT numero_documento FROM huesped WHERE idHUESPED = " . $idhuesped);
                $huesped = $huespedes->fetch_assoc();
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ii", $idhuesped, $idestadia);
                $stmt->execute();
                $res = $stmt->get_result();
                $huespedxestadia = $res->fetch_assoc();
            } else {
                echo "No se ha proporcionado un ID del huésped y de la estadía.";
            }
          ?>

          <h2>Editar Huésped x Estadía</h2>
          <form action="./actualizar/actualizar_huespedxestadia.php" method="post" id="form-huesped-estadia" novalidate>
            <input type="hidden" name="id_huesped_actual" value="<?= $huespedxestadia['HUESPED_idHUESPED'] ?>">
            <input type="hidden" name="id_estadia_actual" value="<?= $huespedxestadia['Estadia_idEstadia'] ?>">

            <div class="mb-3">
              <label for="id_huesped_nuevo" class="form-label">Documento del Huésped</label>
              <input type="number" class="form-control" id="id_huesped_nuevo" name="id_huesped_nuevo" value="<?= $huesped['numero_documento'] ?>" required>
              <div class="valid-feedback d-none">Documento válido.</div>
              <div class="invalid-feedback d-none">Debe tener entre 6 y 15 dígitos numéricos.</div>
            </div>

            <div class="mb-3">
              <label for="id_estadia_nuevo" class="form-label">ID de Estadía</label>
              <input type="number" class="form-control" id="id_estadia_nuevo" name="id_estadia_nuevo" value="<?= $huespedxestadia['Estadia_idEstadia'] ?>" required>
              <div class="valid-feedback d-none">ID válido.</div>
              <div class="invalid-feedback d-none">Debe ser un número mayor que 0.</div>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
          </form>

          <!-- Validación en tiempo real -->
          <script>
            const form = document.getElementById('form-huesped-estadia');
            const doc = document.getElementById('id_huesped_nuevo');
            const estadia = document.getElementById('id_estadia_nuevo');

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

            doc.addEventListener('input', () => {
              const val = doc.value.trim();
              validarCampo(doc, /^\d{6,15}$/.test(val));
            });

            estadia.addEventListener('input', () => {
              const val = parseInt(estadia.value.trim());
              validarCampo(estadia, !isNaN(val) && val > 0);
            });

            form.addEventListener('submit', (e) => {
              const valido = /^\d{6,15}$/.test(doc.value.trim()) && parseInt(estadia.value.trim()) > 0;

              if (!valido) {
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
