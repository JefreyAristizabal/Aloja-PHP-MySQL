<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="card">
        <div class="card-header">
          <span><i class="bi bi-plus me-2"></i></span> Agregar Tarifa
        </div>
        <div class="card-body">
          <h2>Agregar Tarifa</h2>
          <form method="POST" action="guardar_tarifa.php" enctype="multipart/form-data">
              <div class="mb-3">
                  <label for="modalidad_tarifa" class="form-label">Modalidad</label>
                  <input type="text" class="form-control" id="modalidad_tarifa" name="modalidad_tarifa" required>
              </div>
              <div class="mb-3">
                  <label for="nro_huespedes_tarifa" class="form-label">Número de Huespedes</label>
                  <input type="number" class="form-control" id="nro_huespedes_tarifa" name="nro_huespedes_tarifa" required>
              </div>
              <div class="mb-3">
                  <label for="valor_tarifa" class="form-label">Valor</label>
                  <input type="number" class="form-control" id="valor_tarifa" name="valor_tarifa" required>
              </div>
              <div class="mb-3">
                  <label for="id_habitacion_tarifa" class="form-label">ID de Habitación</label>
                  <input type="number" class="form-control" id="id_habitacion_tarifa" name="id_habitacion_tarifa" required>
              </div>
              <button type="submit" class="btn btn-primary">Agregar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>