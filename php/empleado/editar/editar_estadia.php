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
          <span><i class="bi bi-pen me-2"></i></span> Editar Estadía
        </div>
        <div class="card-body">
          <?php 
            include_once '../../../config/conection.php';
            $conn = conectarDB();
            $id = $_GET['id'] ?? null;

            if ($id) {
                $sql = "SELECT * FROM estadia WHERE idEstadia = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $res = $stmt->get_result();
                $estadia = $res->fetch_assoc();
            } else {
                echo "No se ha proporcionado un ID de estadía.";
            }
          ?>
          <h2>Editar Estadía</h2>
          <form id="formulario-estadia" action="./actualizar/actualizar_estadia.php" method="post" enctype="multipart/form-data" novalidate>        
            <input type="hidden" name="id" value="<?= $estadia['idEstadia']?>">

            <!-- Fecha inicio -->
            <div class="mb-3">
              <label for="fechaInicio_estadia" class="form-label">Fecha de inicio</label>
              <input type="date" class="form-control" id="fechaInicio_estadia" name="fechaInicio_estadia" value="<?= $estadia['Fecha_Inicio']?>" required>
              <div class="valid-feedback d-none">Fecha válida.</div>
              <div class="invalid-feedback d-none">Debe ser desde hoy y anterior a la fecha de fin.</div>
            </div>

            <!-- Fecha fin -->
            <div class="mb-3">
              <label for="fechaFin_estadia" class="form-label">Fecha de fin</label>
              <input type="date" class="form-control" id="fechaFin_estadia" name="fechaFin_estadia" value="<?= $estadia['Fecha_Fin']?>" required>
              <div class="valid-feedback d-none">Fecha válida.</div>
              <div class="invalid-feedback d-none">Debe ser posterior a la fecha de inicio.</div>
            </div>

            <!-- Costo -->
            <div class="mb-3">
              <label for="costo_estadia" class="form-label">Costo</label>
              <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" class="form-control" id="costo_estadia" name="costo_estadia" value="<?= $estadia['Costo']?>" required>
              </div>
              <div class="valid-feedback">Costo válido.</div>
              <div class="invalid-feedback">Debe ser mayor a cero.</div>
            </div>

            <!-- ID habitación -->
            <div class="mb-3">
              <label for="id_habitacion_estadia" class="form-label">ID de Habitación</label>
              <input type="number" name="id_habitacion_estadia" id="id_habitacion_estadia" class="form-control" value="<?= $estadia['Habitacion_idHabitacion']?>" required>
              <div class="valid-feedback">ID válido.</div>
              <div class="invalid-feedback">Debe ser un número mayor a 0.</div>
            </div>

            <div id="error" class="text-danger mb-3"></div>

            <button class="btn btn-primary">Actualizar</button>
          </form>

          <!-- Script validación -->
          <script>
            const form = document.getElementById('formulario-estadia');
            const inicio = document.getElementById('fechaInicio_estadia');
            const fin = document.getElementById('fechaFin_estadia');
            const costo = document.getElementById('costo_estadia');
            const habitacion = document.getElementById('id_habitacion_estadia');

            const validarInput = (input, condicion) => {
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

            inicio.addEventListener('input', () => {
              const hoy = new Date();
              hoy.setHours(0, 0, 0, 0);
              const ini = new Date(inicio.value);
              const finDate = new Date(fin.value);
              validarInput(inicio, ini >= hoy && ini < finDate);
            });

            fin.addEventListener('input', () => {
              const ini = new Date(inicio.value);
              const finDate = new Date(fin.value);
              validarInput(fin, finDate > ini);
            });

            costo.addEventListener('input', () => {
              validarInput(costo, parseFloat(costo.value) > 0);
            });

            habitacion.addEventListener('input', () => {
              validarInput(habitacion, parseInt(habitacion.value) > 0);
            });

            // Validación al enviar
            form.addEventListener('submit', (e) => {
              const hoy = new Date(); hoy.setHours(0, 0, 0, 0);
              const ini = new Date(inicio.value);
              const finDate = new Date(fin.value);

              if (!(ini >= hoy && ini < finDate)) e.preventDefault();
              if (!(finDate > ini)) e.preventDefault();
              if (!(parseFloat(costo.value) > 0)) e.preventDefault();
              if (!(parseInt(habitacion.value) > 0)) e.preventDefault();

              form.classList.add('was-validated');
            });
          </script>
        </div>
      </div>
    </div>
  </div>
</div>
