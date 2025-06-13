<?php
include_once '../../../config/conection.php';
$conn = conectarDB();

$sql5 = "SELECT * FROM habitacion";
$res5 = $conn->query($sql5);
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="card">
        <div class="card-header">
          <span><i class="bi bi-table me-2"></i></span> Habitaciones
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
                  <th>ID de Habitación</th>
                  <th>Nombre</th>
                  <th>Capacidad</th>
                  <th>Descripción</th>
                  <th>Imagen</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>
                <?php while($row = $res5->fetch_assoc()): ?>
                     <tr>
                         <td><?=  $row['idHABITACION']?></td>
                         <td><?= $row['NOMBRE']?></td>
                         <td><?= $row['CAPACIDAD']?></td>
                         <td><?= $row['DESCRIPCION']?></td>
                         <td><?= $row['IMAGEN']?></td>
                         <div class="d-flex justify-content-center gap-1">
                             <td class="text-center ">
                             <a href="?section=editar/editar_habitacion&id=<?= $row['idHABITACION'] ?>" class="btn btn-success">Editar</a>
                             </td>
                         </div>                        
                     </tr>
                <?php  endwhile; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>ID de Habitación</th>
                  <th>Nombre</th>
                  <th>Capacidad</th>
                  <th>Descripción</th>
                  <th>Imagen</th>
                  <th>Acción<span class="invisible">........................</span></th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>