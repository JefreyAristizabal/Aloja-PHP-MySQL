<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="card">
        <div class="card-header">
          <span><i class="bi bi-plus me-2"></i></span> Agregar Estadía
        </div>
        <div class="card-body">
          <h2>Agregar Estadía</h2>
          <form action="guardar_estadia.php" method="POST" enctype="multipart/form-data" id="formulario-estadia">
              <div class="mb-3">
                <label for="fechaInicio_estadia" class="form-label">Fecha de inicio</label>
                <input type="date" class="form-control" id="fechaInicio_estadia" name="fechaInicio_estadia" required>
              </div>
              <div class="mb-3">
                <label for="fechaFin_estadia" class="form-label">Fecha de fin</label>
                <input type="date" class="form-control" id="fechaFin_estadia" name="fechaFin_estadia" required>
              </div>
              <div class="mb-3">
                <label for="costo_estadia" class="form-label">Costo</label>
                <div class="input-group">
                  <span class="input-group-text">$</span>
                  <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" id="costo_estadia" name="costo_estadia" required>
                </div>
              </div>
              <div class="mb-3">
                <label for="id_habitacion_estadia" class="form-label">ID de Habitación</label>
                <input type="number" name="id_habitacion_estadia" id="id_habitacion_estadia" class="form-control" required>
              </div>
              <div id="error" class="text-danger mb-3"></div>
              <button type="submit" class="btn btn-primary mb-2">Guardar</button>
              <script>
                function mostrarFormulario() {
                  document.getElementById('container9').style.display = 'block';
                  document.getElementById('container1').style.display = 'none';
                }
              
                document.getElementById('formulario-estadia').addEventListener('submit', function (e) {
                  const inicio = new Date(document.getElementById('fechaInicio_estadia').value);
                  const fin = new Date(document.getElementById('fechaFin_estadia').value);
                  const hoy = new Date();
                  hoy.setHours(0, 0, 0, 0);
                
                  const error = document.getElementById('error');
                
                  if (inicio < hoy) {
                    e.preventDefault();
                    error.textContent = "La fecha de inicio no puede ser anterior a hoy.";
                  } else if (inicio >= fin) {
                    e.preventDefault();
                    error.textContent = "La fecha de inicio debe ser menor que la fecha de fin.";
                  } else {
                    error.textContent = "";
                  }
                });
              
                window.onload = function () {
                  mostrarFormulario(); 
                };
              </script>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>