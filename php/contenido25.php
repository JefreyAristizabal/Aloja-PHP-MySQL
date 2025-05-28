<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="card">
        <div class="card-header">
          <span><i class="bi bi-pen me-2"></i></span> Editar Novedad
        </div>
        <div class="card-body">
          <?php 
            include_once '../config/conection.php';
            $conn = conectarDB();
                
            $id = $_GET['id'] ?? null;
                
            if ($id) {
                $sql = "SELECT * FROM novedades WHERE idNovedades = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $res = $stmt->get_result();
                $novedad = $res->fetch_assoc();
            } else {
                echo "No se ha proporcionado un ID de novedad.";
            }
          ?>
          <h2>Editar Tarifa</h2>
          <form action="actualizar_novedad.php" method="post" enctype="multipart/form-data">        
            <input type="hidden" name="id" value="<?= $novedad['idNovedades']?>">
            <div class="input-group mb-3">
                <span class="input-group-text">Descripción</span>
                <textarea class="form-control" aria-label="With textarea" name="descripcion_novedad" id="descripcion_novedad"><?= $novedad['Descripcion']?></textarea>
            </div>
            <div class="mb-3">
                <label for="id_estadia_novedad" class="form-label">ID de Estadía</label>
                <input type="number" class="form-control" id="id_estadia_novedad" name="id_estadia_novedad" value="<?= $novedad['Estadia_idEstadia']?>" required>
            </div>
            <button class="btn btn-primary">Actualizar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>