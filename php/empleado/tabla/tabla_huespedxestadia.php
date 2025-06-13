<?php
include_once '../../../config/conection.php';
$conn = conectarDB();

$sql3 = "SELECT * FROM huesped_has_estadia";
$res3 = $conn->query($sql3);
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="card">
        <div class="card-header">
          <span><i class="bi bi-table me-2"></i></span> Huesped x Estadía
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table
              id="example"
              class="table table-striped data-table"
              style="width: 100%"
            >
              <thead>
                <tr>
                  <th>Documento del Huesped</th>
                  <th>ID de Estadía</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>
                <?php while($row = $res3->fetch_assoc()): ?>
                  <?php 
                    $huespedes = $conn->query("SELECT numero_documento FROM huesped WHERE idHUESPED = " . $row['HUESPED_idHUESPED']);
                    $huesped = $huespedes->fetch_assoc();
                    ?>
                     <tr>
                         <td><?=  $huesped['numero_documento']?></td>
                         <td><?= $row['Estadia_idEstadia']?></td>
                         <div class="d-flex justify-content-center gap-1">
                             <td class="text-center">
                             <a href="?section=editar/editar_empleado&idhuesped=<?= $row['HUESPED_idHUESPED'] ?>&idestadia=<?= $row['Estadia_idEstadia'] ?>" class="btn btn-success">Editar</a>
                             </td>
                         </div>                      
                     </tr>
                <?php  endwhile; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>Documento del Huesped</th>
                  <th>ID de Estadía</th>
                  <th>Acción</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>