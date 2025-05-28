<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="card">
        <div class="card-header">
          <span><i class="bi bi-pen me-2"></i></span> Editar Huesped
        </div>
        <div class="card-body">
          <?php 
            include_once '../config/conection.php';
            $conn = conectarDB();
                
            $id = $_GET['id'] ?? null;
                
            if ($id) {
                $sql = "SELECT * FROM huesped WHERE idHUESPED = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $res = $stmt->get_result();
                $huesped = $res->fetch_assoc();
            } else {
                echo "No se ha proporcionado un ID de huesped.";
            }
          ?>
          <h2>Editar Huesped</h2>
          <form action="actualizar_huesped.php" method="post" enctype="multipart/form-data">        
            <input type="hidden" name="id" value="<?= $huesped['idHUESPED']?>">
            <div class="form-floating my-3">
                <input type="text" name="nombre_huesped" id="nombre_huesped" class="form-control" placeholder="" value="<?= $huesped['Nombre_completo']?>" required>
                <label for="nombre_huesped">Nombre completo</label>
            </div>
            <div class="input-group">
                <label class="input-group-text" for="tipodocumento">Tipo de documento</label>
                <select class="form-select" id="tipodocumento" name="tipodocumento" value="<?= $huesped['tipo_documento']?>" required>
                    <option selected>Selecciona una opcion</option>
                    <option value="tarjeta">TI</option>
                    <option value="cedula">Cedula de ciudadania</option>
                    <option value="otros">otro</option>
                </select>
            </div>
            <div class="form-floating my-3">
                <input type="text" name="numero_documento_huesped" id="numero_documento_huesped" class="form-control" placeholder="" value="<?= $huesped['Numero_documento']?>" required>
                <label for="numero_documento_huesped">Número de documento</label>
            </div>
            <div class="form-floating my-3">
                <input class="form-control" type="text" name="telefono_huesped" id="telefono_huesped" placeholder="" value="<?= $huesped['Telefono_huesped']?>" required>
                <label for="telefono_huesped">Teléfono</label>
            </div>
            <div class="form-floating my-3">
                <input type="text" name="ciudad_huesped" id="ciudad_huesped" class="form-control" placeholder="" value="<?= $huesped['Origen']?>" required>
                <label for="ciudad_huesped">Ciudad</label>
            </div>
            <div class="form-floating">
                <input class="form-control" type="text" name="nombre_contacto_huesped" id="nombre_contacto_huesped" placeholder="" value="<?= $huesped['Nombre_Contacto']?>">
                <label for="nombre_contacto_huesped">Nombre de contacto</label>
            </div>
            <div class="form-floating my-3">
                <input class="form-control" type="text" name="telefono_contacto_huesped" id="telefono_contacto_huesped" placeholder="" value="<?= $huesped['Telefono_contacto']?>">
                <label for="telefono_contacto_huesped">Telefono de contacto</label>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Observaciones</span>
                <textarea class="form-control" aria-label="With textarea" name="observaciones_huesped" id="observaciones_huesped"><?= $huesped['Observaciones']?></textarea>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Otras Observaciones</span>
                <textarea class="form-control" aria-label="With textarea" name="otras_observaciones_huesped" id="otras_observaciones_huesped"><?= $huesped['observaciones2']?></textarea>
            </div>
            <button class="btn btn-primary">Actualizar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>