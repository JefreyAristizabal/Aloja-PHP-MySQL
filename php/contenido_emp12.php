<?php
session_start();
include '../config/conection.php'; 

if (isset($_SESSION['idEmpleado'])) {
  $idEmpleado = $_SESSION['idEmpleado'];
} else {
  echo "No has iniciado sesión.";
}
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
          <form method="POST" action="guardar_pago.php" enctype="multipart/form-data">
              <div class="mb-3">
                  <label for="fecha_pago" class="form-label">Fecha de Pago</label>
                  <input type="datetime-local" class="form-control" id="fecha_pago" name="fecha_pago" required>
              </div>
              <div class="mb-3">
                  <label for="valor_pago" class="form-label">Valor</label>
                  <input type="number" class="form-control" id="valor_pago" name="valor_pago" required>
              </div>
              <div class="mb-3">
                  <label for="id_huesped_pago" class="form-label">ID de Huesped</label>
                  <input type="number" class="form-control" id="id_huesped_pago" name="id_huesped_pago" required>
              </div>
              <div class="mb-3">
                  <label for="id_estadia_pago" class="form-label">ID de Estadía</label>
                  <input type="number" class="form-control" id="id_estadia_pago" name="id_estadia_pago" required>
              </div>
              <input type="hidden" name="id_empleado_pago" value="<?= $idEmpleado ?>">
              <div class="input-group mb-3">
                  <span class="input-group-text">Observación</span>
                  <textarea class="form-control" aria-label="With textarea" name="observacion" id="observacion"></textarea>
              </div>
              <div class="mb-3">
                  <label for="imagen" class="form-label">Imagen de el pago</label>
                  <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                  <br>
                  <img id="vista-previa" src="#" alt="Vista previa de la imagen" class="img-fluid mt-2 d-none" width="200">
              </div>
              <button type="submit" class="btn btn-primary">Agregar</button>
          </form>
          <script>
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
        </div>
      </div>
    </div>
  </div>
</div>