<?php
include_once '../../../config/conection.php';
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
                  <th>Acción</th>
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
                         <div class="d-flex justify-content-center gap-1">
                             <td class="text-center ">
                             <a href="?section=editar/editar_tarifa&id=<?= $row['idTarifa'] ?>" class="btn btn-success">Editar</a>
                             <a class="btn btn-danger" href="#" onclick="confirmarEliminacion(<?= ($row['idTarifa']) ?>)">Eliminar</a>
                             </td>
                         </div>                        
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
                      window.location.href = './eliminar/eliminar_tarifa.php?id=' + id; 
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