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
          <span><i class="bi bi-pen me-2"></i></span> Editar Novedad
        </div>
        <div class="card-body">
          <?php 
            include_once '../../../config/conection.php';
            $conn = conectarDB();

            $id = $_GET['id'] ?? null;

            if ($id) {
                $sql = "SELECT * FROM novedades WHERE idNovedades = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $res = $stmt->get_result();
                $novedad = $res->fetch_assoc();
            } else {
                echo "No se ha proporcionado un ID de novedad.";
              return;
            }
          ?>
          <h2>Editar Novedad</h2>
          <form action="./actualizar/actualizar_novedad.php" method="post" id="form-novedad" novalidate>        
            <input type="hidden" name="id" value="<?= $novedad['idNovedades'] ?>">

            <!-- Descripción -->
            <div class="mb-3">
              <label for="descripcion_novedad" class="form-label">Descripción</label>
              <textarea class="form-control" id="descripcion_novedad" name="descripcion_novedad" rows="3" required><?= $novedad['Descripcion'] ?></textarea>
              <div class="valid-feedback d-none">Descripción válida.</div>
              <div class="invalid-feedback d-none">La descripción no puede estar vacía.</div>
            </div>

            <!-- ID de estadía -->
            <div class="mb-3">
              <label for="id_estadia_novedad" class="form-label">ID de Estadía</label>
              <input type="number" class="form-control" id="id_estadia_novedad" name="id_estadia_novedad" value="<?= $novedad['Estadia_idEstadia'] ?>" required>
              <div class="valid-feedback d-none">ID válido.</div>
              <div class="invalid-feedback d-none">Debe ser un número mayor que 0.</div>
            </div>

            <button class="btn btn-primary">Actualizar</button>
          </form>

          <!-- Script de validación -->
          <script>
            const form = document.getElementById('form-novedad');
            const descripcion = document.getElementById('descripcion_novedad');
            const estadiaId = document.getElementById('id_estadia_novedad');

            function validarCampo(input, condicion) {
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
            }

            descripcion.addEventListener('input', () => {
              validarCampo(descripcion, descripcion.value.trim().length > 0);
            });

            estadiaId.addEventListener('input', () => {
              const valor = parseInt(estadiaId.value.trim());
              validarCampo(estadiaId, !isNaN(valor) && valor > 0);
            });

            form.addEventListener('submit', (e) => {
              const descOk = descripcion.value.trim().length > 0;
              const idOk = !isNaN(parseInt(estadiaId.value)) && parseInt(estadiaId.value) > 0;

              if (!descOk || !idOk) {
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
