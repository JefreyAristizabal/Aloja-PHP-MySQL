<?php
include_once '../config/conection.php';
$conn = conectarDB();

$sql6 = "SELECT * FROM tarifa";
$res6 = $conn->query($sql6);
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="card">
        <div class="card-header">
          <span><i class="bi bi-table me-2"></i></span> Tarifas
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
                  <th>ID de Tarifa</th>
                  <th>Modalidad</th>
                  <th>Número de Huespedes</th>
                  <th>Valor</th>
                  <th>ID de Habitación</th>
                </tr>
              </thead>
              <tbody>
                <?php while($row = $res6->fetch_assoc()): ?>
                     <tr>
                         <td><?=  $row['idTarifa']?></td>
                         <td><?= $row['Modalidad']?></td>
                         <td><?= $row['NroHuespedes']?></td>
                         <td><?= $row['Valor']?></td>
                         <td><?= $row['Habitacion_idHabitacion']?></td>                      
                     </tr>
                <?php  endwhile; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>ID de Tarifa</th>
                  <th>Modalidad</th>
                  <th>Número de Huespedes</th>
                  <th>Valor</th>
                  <th>ID de Habitación</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>