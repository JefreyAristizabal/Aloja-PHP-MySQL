<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="card">
        <div class="card-header">
          <span><i class="bi bi-pen me-2"></i></span> Editar Huesped x Estadía
        </div>
        <div class="card-body">
          <?php 
            include_once '../config/conection.php';
            $conn = conectarDB();
                
            $idhuesped = $_GET['idhuesped'] ?? null;
            $idestadia = $_GET['idestadia'] ?? null;
                
            if ($idhuesped && $idestadia) {
                $sql = "SELECT * FROM huesped_has_estadia WHERE HUESPED_idHUESPED = ? AND Estadia_idEstadia = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ii", $idhuesped, $idestadia);
                $stmt->execute();
                $res = $stmt->get_result();
                $huespedxestadia = $res->fetch_assoc();
            } else {
                echo "No se ha proporcionado un ID del huesped y de la estadía.";
            }
          ?>
          <h2>Editar Huesped x Estadía</h2>
          <form action="actualizar_huespedxestadia.php" method="post" enctype="multipart/form-data">        
            <input type="hidden" name="id_huesped_actual" value="<?= $huespedxestadia['HUESPED_idHUESPED']?>">
            <input type="hidden" name="id_estadia_actual" value="<?= $huespedxestadia['Estadia_idEstadia']?>">   
            <div class="mb-3">
              <label for="id_huesped_nuevo" class="form-label">ID de Huesped</label>
              <input type="number" class="form-control" id="id_huesped_nuevo" name="id_huesped_nuevo" value="<?= $huespedxestadia['HUESPED_idHUESPED'] ?>" required>
            </div>
            <div class="mb-3">
              <label for="id_estadia_nuevo" class="form-label">ID de Estadía</label>
              <input type="number" class="form-control" id="id_estadia_nuevo" name="id_estadia_nuevo" value="<?= $huespedxestadia['Estadia_idEstadia'] ?>" required>
            </div>
            <button class="btn btn-primary">Actualizar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>