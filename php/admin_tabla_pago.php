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
                  <th>Identificación del Huesped</th>
                  <th>ID de Estadía</th>
                  <th>Nombre del Empleado</th>
                  <th>Imagen</th>
                  <th>Observación</th>
                  <th>Acción<span class="invisible">.................</span></th>
                </tr>
              </thead>
              <tbody>
                <?php while($row = $res7->fetch_assoc()): ?>
                    <?php 
                      $sql_huesped = "SELECT numero_documento FROM huesped WHERE idHUESPED = " . $row['HUESPED_idHUESPED'];
                      $resultado_huesped = $conn->query($sql_huesped);
                      $huesped = $resultado_huesped->fetch_assoc();
                      $sql_empleado = "SELECT Nombre_Completo FROM empleado WHERE idEmpleado = " . $row['Empleado_idEmpleado'];
                      $resultado_empleado = $conn->query($sql_empleado);
                      $empleado = $resultado_empleado->fetch_assoc();
                      ?>
                     <tr>
                         <td><?=  $row['idPagos']?></td>
                         <td><?= $row['Fecha_Pago']?></td>
                         <td><?= $row['Valor']?></td>
                         <td><?= $huesped['numero_documento']?></td>
                         <td><?= $row['Estadia_idEstadia']?></td>
                         <td><?= $empleado['Nombre_Completo']?></td>
                         <td><?= $row['Imagen'] ?></td>
                         <td><?= $row['Observacion'] ?></td>
                         <div class="d-flex justify-content-center gap-1">
                             <td class="text-center ">
                             <a href="?section=editar_pago&id=<?= $row['idPagos'] ?>" class="btn btn-success">Editar</a>
                             <a class="btn btn-danger" href="#" onclick="confirmarEliminacion(<?= ($row['idPagos']) ?>)">Eliminar</a>
                             </td>
                         </div>                        
                     </tr>
                <?php  endwhile; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>ID de Pago</th>
                  <th>Fecha de Pago</th>
                  <th>Valor</th>
                  <th>Identificación del Huesped</th>
                  <th>ID de Estadía</th>
                  <th>Nombre del Empleado</th>
                  <th>Imagen</th>
                  <th>Observación</th>
                  <th>Acción</th>
                </tr>
              </tfoot>
            </table>
            <script>
                function confirmarEliminacion(id) {
                  Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡Esta acción no se puede deshacer!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar',
                  }).then((result) => {
                    if (result.isConfirmed) {
                      console.log("Redirigiendo a eliminar_tarifa.php?id=" + id);
                      window.location.href = 'eliminar_pago.php?id=' + id; 
                    } else {
                      Swal.fire('Cancelado', 'La acción ha sido cancelada.', 'info');
                    }
                  });
                }
            </script>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>