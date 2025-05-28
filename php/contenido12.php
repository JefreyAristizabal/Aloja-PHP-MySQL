<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="card">
        <div class="card-header">
          <span><i class="bi bi-plus me-2"></i></span> Agregar Habitación
        </div>
        <div class="card-body">
          <h2>Agregar Habitación</h2>
          <form action="guardar_habitacion.php" method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                  <label for="nombre_habitacion" class="form-label">Nombre de la Habitación</label>
                  <input type="text" class="form-control" id="nombre_habitacion" name="nombre_habitacion">
              </div>
              <div class="mb-3">
                  <label for="capacidad" class="form-label">Capacidad</label>
                  <input type="number" class="form-control" id="capacidad" name="capacidad" min="1" max="10" required>
              </div>

              <div class="mb-3">
                  <label for="descripcion_habitacion" class="form-label">Descripción</label>
                  <input type="text" class="form-control" id="descripcion_habitacion" name="descripcion_habitacion">
              </div>
              <div class="mb-3">
                  <label for="imagen" class="form-label">Imagen de la Habitación</label>
                  <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
                  <br>
                  <img id="vista-previa" src="#" alt="Vista previa de la imagen" class="img-fluid mt-2 d-none" width="200">
              </div>
              <button type="submit" class="btn btn-primary mb-2">Guardar</button>
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
          </form>
        </div>
      </div>
    </div>
  </div>
</div>