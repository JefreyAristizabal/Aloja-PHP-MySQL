<?php
include_once '../config/conection.php';
$conn = conectarDB();

$sql7 = "SELECT * FROM pagos";
$res7 = $conn->query($sql7);
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="card">
        <div class="card-header">
          <span><i class="bi bi-table me-2"></i></span> Pagos
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
                  <th>ID de Pago</th>
                  <th>Fecha de Pago<span class="invisible">....................</span></th>
                  <th>Valor</th>
                  <th>ID de Huesped</th>
                  <th>ID de Estadía</th>
                  <th>ID de Empleado</th>
                  <th>Imagen</th>
                  <th>Observación</th>
                </tr>
              </thead>
              <tbody>
                <?php while($row = $res7->fetch_assoc()): ?>
                     <tr>
                         <td><?=  $row['idPagos']?></td>
                         <td><?= $row['Fecha_Pago']?></td>
                         <td><?= $row['Valor']?></td>
                         <td><?= $row['HUESPED_idHUESPED']?></td>
                         <td><?= $row['Estadia_idEstadia']?></td>
                         <td><?= $row['Empleado_idEmpleado']?></td>
                         <td><?= $row['Imagen'] ?></td>
                         <td><?= $row['Observacion'] ?></td>                     
                     </tr>
                <?php  endwhile; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>ID de Pago</th>
                  <th>Fecha de Pago</th>
                  <th>Valor</th>
                  <th>ID de Huesped</th>
                  <th>ID de Estadía</th>
                  <th>ID de Empleado</th>
                  <th>Imagen</th>
                  <th>Observación</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>