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
          <form action="./actualizar/actualizar_estadia.php" method="post" enctype="multipart/form-data">        
            <input type="hidden" name="id" value="<?= $estadia['idEstadia']?>">
            <div class="mb-3">
              <label for="fechaInicio_estadia" class="form-label">Fecha de inicio</label>
              <input type="date" class="form-control" id="fechaInicio_estadia" name="fechaInicio_estadia" value="<?= $estadia['Fecha_Inicio']?>" required>
            </div>
            <div class="mb-3">
              <label for="fechaFin_estadia" class="form-label">Fecha de fin</label>
              <input type="date" class="form-control" id="fechaFin_estadia" name="fechaFin_estadia" value="<?= $estadia['Fecha_Fin']?>" required>
            </div>
            <div class="mb-3">
              <label for="costo_estadia" class="form-label">Costo</label>
              <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" id="costo_estadia" name="costo_estadia" value="<?= $estadia['Costo']?>" required>
              </div>
            </div>
            <div class="mb-3">
              <label for="id_habitacion_estadia" class="form-label">ID de Habitación</label>
              <input type="number" name="id_habitacion_estadia" id="id_habitacion_estadia" class="form-control" value="<?= $estadia['Habitacion_idHabitacion']?>" required>
            </div>
            <div id="error" class="text-danger mb-3"></div>
            <button class="btn btn-primary">Actualizar</button>
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