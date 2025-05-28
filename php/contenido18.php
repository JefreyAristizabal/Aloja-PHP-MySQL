<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="card">
        <div class="card-header">
          <span><i class="bi bi-pen me-2"></i></span> Editar Habitación
        </div>
        <div class="card-body">
          <?php 
            include_once '../config/conection.php';
            $conn = conectarDB();
                
            $id = $_GET['id'] ?? null;
                
            if ($id) {
                $sql = "SELECT * FROM HABITACION WHERE idHABITACION = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $res = $stmt->get_result();
                $habitacion = $res->fetch_assoc();
            } else {
                echo "No se ha proporcionado un ID de habitación.";
            }
          ?>
          <h2>Editar habitacion</h2>
          <form action="actualizar_habitacion.php" method="post" enctype="multipart/form-data">        
            <input type="hidden" name="id" value="<?= $habitacion['idHABITACION']?>">
            <div class="mb-3">
               <label for="nombre_habitacion" class="form-label">Nombre de habitacion</label>
               <input class="form-control" type="text" name="nombre_habitacion" id="nombre_habitacion" value="<?= $habitacion['NOMBRE'] ?>" required>
            </div>
                
            <div class="mb-3">
               <label for="capacidad" class="form-label">Capacidad</label>
               <input class="form-control" type="text" name="capacidad" id="capacidad" value="<?= $habitacion['CAPACIDAD'] ?>" required>
            </div>

            <div class="mb-3">
                  <label for="descripcion_habitacion" class="form-label">Descripción</label>
                  <input type="text" class="form-control" id="descripcion_habitacion" name="descripcion_habitacion" value="<?= $habitacion['DESCRIPCION'] ?>" required>
            </div>
                
            <div class="mb-3">
               <label for="imagen" class="form-label">Imagen Actual:</label><br>
               <img src="<?= $habitacion['IMAGEN']?>" width="200" alt="habitacion"><br><br>
               <label for="imagen" class="form-label">Cambiar imagen(opcional)</label><br>
               <input type="file" class="form-control" name="imagen" id="imagen" accept="image/*">
            </div>
                
            <button class="btn btn-primary">Actualizar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>