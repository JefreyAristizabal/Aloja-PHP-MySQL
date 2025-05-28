<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="card">
        <div class="card-header">
          <span><i class="bi bi-plus me-2"></i></span> Agregar Huesped x Estadía
        </div>
        <div class="card-body">
          <h2>Agregar Huesped x Estadía</h2>
          <form action="guardar_huespedxestadia.php" method="POST" enctype="multipart/form-data" id="formulario-estadia">
              <div class="mb-3">
                <label for="id_huesped" class="form-label">ID de Huesped</label>
                <input type="number" class="form-control" id="id_huesped" name="id_huesped" required>
              </div>
              <div class="mb-3">
                <label for="id_estadia" class="form-label">ID de Estadía</label>
                <input type="number" class="form-control" id="id_estadia" name="id_estadia" required>
              </div>
              <button type="submit" class="btn btn-primary mb-2">Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>