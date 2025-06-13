<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="card">
        <div class="card-header">
          <span><i class="bi bi-pen me-2"></i></span> Editar Pago
        </div>
        <div class="card-body">
          <?php 
            include_once '../../../config/conection.php';
            $conn = conectarDB();
                
            $id = $_GET['id'] ?? null;
                
            if ($id) {
                $sql = "SELECT * FROM pagos WHERE idPagos = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $res = $stmt->get_result();
                $pago = $res->fetch_assoc();
                $sql_huesped = "SELECT numero_documento FROM huesped WHERE idHUESPED = " . $pago['HUESPED_idHUESPED'];
                $resultado_huesped = $conn->query($sql_huesped);
                $huesped = $resultado_huesped->fetch_assoc();
            } else {
                echo "No se ha proporcionado un ID de pago.";
            }
          ?>
          <h2>Editar Pago</h2>
          <form action="./actualizar/actualizar_pago.php" method="post" enctype="multipart/form-data">        
            <input type="hidden" name="id" value="<?= $pago['idPagos']?>">
            <div class="mb-3">
                <label for="fecha_pago" class="form-label">Fecha de Pago</label>
                <input type="datetime-local" class="form-control" id="fecha_pago" name="fecha_pago" value="<?= $pago['Fecha_Pago']?>" required>
            </div>
            <div class="mb-3">
                <label for="valor_pago" class="form-label">Valor</label>
                <input type="number" class="form-control" id="valor_pago" name="valor_pago" value="<?= $pago['Valor']?>" required>
            </div>
            <div class="mb-3">
                <label for="id_huesped_pago" class="form-label">Identificación del Huesped</label>
                <input type="number" class="form-control" id="id_huesped_pago" name="id_huesped_pago" value="<?= $huesped['numero_documento']?>" required>
            </div>
            <div class="mb-3">
                <label for="id_estadia_pago" class="form-label">ID de Estadía</label>
                <input type="number" class="form-control" id="id_estadia_pago" name="id_estadia_pago" value="<?= $pago['Estadia_idEstadia']?>" required>
            </div>
            <input type="hidden" name="id_empleado_pago" value="<?= $pago['Empleado_idEmpleado']?>">
            <div class="input-group mb-3">
                <span class="input-group-text">Observación</span>
                <textarea class="form-control" aria-label="With textarea" name="observacion" id="observacion"><?= $pago['Observacion']?></textarea>
            </div>
            <div class="mb-3">
               <label for="imagen" class="form-label">Imagen Actual:</label><br>
               <img src="<?= $pago['Imagen']?>" width="200" alt="pago"><br><br>
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