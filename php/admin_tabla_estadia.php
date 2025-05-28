<?php
include_once '../config/conection.php';
$conn = conectarDB();

$sql1 = "SELECT * FROM estadia";
$res1 = $conn->query($sql1);
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="card">
        <div class="card-header">
          <span><i class="bi bi-table me-2"></i></span> Estadias
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
                  <th>ID de Estadía</th>
                  <th>Fecha de Inicio</th>
                  <th>Fecha de Fin</th>
                  <th>Fecha de Registro</th>
                  <th>Costo</th>
                  <th>ID de Habitación</th>
                  <th>Acción<span class="invisible">....................</span></th>
                </tr>
              </thead>
              <tbody>
                <?php while($row = $res1->fetch_assoc()): ?>
                     <tr>
                         <td><?=  $row['idEstadia']?></td>
                         <td><?= $row['Fecha_Inicio']?></td>
                         <td><?= $row['Fecha_Fin']?></td>
                         <td><?= $row['Fecha_Registro']?></td>
                         <td><?= $row['Costo']?></td>
                         <td><?= $row['Habitacion_idHabitacion']?></td>
                         <div class="d-flex justify-content-center gap-1">
                             <td class="text-center ">
                             <a href="#" class="btn btn-success btn-editar-estadia" data-id="<?= $row['idEstadia'] ?>">Editar</a>
                             <a class="btn btn-danger" href="#" onclick="confirmarEliminacion(<?= ($row['idEstadia']) ?>)">Eliminar</a>
                             </td>
                         </div>                        
                     </tr>
                <?php  endwhile; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>ID de Estadía</th>
                  <th>Fecha de Inicio</th>
                  <th>Fecha de Fin</th>
                  <th>Fecha de Registro</th>
                  <th>Costo</th>
                  <th>ID de Habitación</th>
                  <th>Acción</th>
                </tr>
              </tfoot>
            </table>
            <script>
            $(document).ready(function () {
              $(document).on('click', '.btn-editar-estadia', function (e) {
                e.preventDefault();
              
                const idEstadia = $(this).data('id');
              
                const $contenedor15 = $('#container15');
              
                $contenedor15.removeClass('d-none').addClass('d-block');
              
                for (let i = 1; i <= 25; i++) {
                  if (i !== 15) {
                    $('#container' + i).removeClass('d-block').addClass('d-none');
                  }
                }
              
                $contenedor15.load(`contenido15.php?id=${idEstadia}`);
              });
            });
          </script>
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
                    console.log("Redirigiendo a eliminar_estadia.php?id=" + id);
                    window.location.href = 'eliminar_estadia.php?id=' + id; 
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