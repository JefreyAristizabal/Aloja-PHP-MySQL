<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="card">
        <div class="card-header">
          <span><i class="bi bi-pen me-2"></i></span> Editar Tarifa
        </div>
        <div class="card-body">
          <?php 
            include_once '../config/conection.php';
            $conn = conectarDB();
                
            $id = $_GET['id'] ?? null;
                
            if ($id) {
                $sql = "SELECT * FROM tarifa WHERE idTarifa = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $res = $stmt->get_result();
                $tarifa = $res->fetch_assoc();
            } else {
                echo "No se ha proporcionado un ID de tarifa.";
            }
          ?>
          <h2>Editar Tarifa</h2>
          <form action="actualizar_tarifa.php" method="post" enctype="multipart/form-data">        
            <input type="hidden" name="id" value="<?= $tarifa['idTarifa']?>">
            <div class="mb-3">
                <label for="modalidad_tarifa" class="form-label">Modalidad</label>
                <input type="text" class="form-control" id="modalidad_tarifa" name="modalidad_tarifa" value="<?= $tarifa['Modalidad']?>" required>
            </div>
            <div class="mb-3">
                <label for="nro_huespedes_tarifa" class="form-label">Número de Huespedes</label>
                <input type="number" class="form-control" id="nro_huespedes_tarifa" name="nro_huespedes_tarifa" value="<?= $tarifa['NroHuespedes']?>" required>
            </div>
            <div class="mb-3">
                <label for="valor_tarifa" class="form-label">Valor</label>
                <input type="number" class="form-control" id="valor_tarifa" name="valor_tarifa" value="<?= $tarifa['Valor']?>" required>
            </div>
            <div class="mb-3">
                <label for="id_habitacion_tarifa" class="form-label">ID de Habitación</label>
                <input type="number" class="form-control" id="id_habitacion_tarifa" name="id_habitacion_tarifa" value="<?= $tarifa['Habitacion_idHabitacion']?>" required>
            </div>
            <button class="btn btn-primary">Actualizar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>