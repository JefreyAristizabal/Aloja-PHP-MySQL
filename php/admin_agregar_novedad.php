<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="card">
        <div class="card-header">
          <span><i class="bi bi-plus me-2"></i></span> Agregar Novedad
        </div>
        <div class="card-body">
          <h2>Agregar Noveadad</h2>
          <form method="POST" action="guardar_novedad.php" enctype="multipart/form-data">
              <div class="input-group mb-3">
                  <span class="input-group-text">Descripción</span>
                  <textarea class="form-control" aria-label="With textarea" name="descripcion_novedad" id="descripcion_novedad"></textarea>
              </div>
              <div class="mb-3">
                  <label for="id_estadia_novedad" class="form-label">ID de Estadía</label>
                  <input type="number" class="form-control" id="id_estadia_novedad" name="id_estadia_novedad" required>
              </div>
              <button type="submit" class="btn btn-primary">Agregar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>