<?php
include_once '../config/conection.php';
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
                             <a href="#" class="btn btn-success btn-editar-habitacion" data-id="<?= $row['idHABITACION'] ?>">Editar</a>
                             <a class="btn btn-danger" href="#" onclick="confirmarEliminacion(<?= ($row['idHABITACION']) ?>)">Eliminar</a>
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
            <script>
                $(document).ready(function () {
                  $(document).on('click', '.btn-editar-habitacion', function (e) {
                    e.preventDefault();

                    const idHabitacion = $(this).data('id');

                    const $contenedor18 = $('#container18');

                    $contenedor18.removeClass('d-none').addClass('d-block');

                    for (let i = 1; i <= 25; i++) {
                      if (i !== 18) {
                        $('#container' + i).removeClass('d-block').addClass('d-none');
                      }
                    }
                
                    $contenedor18.load(`contenido18.php?id=${idHabitacion}`);
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
                      console.log("Redirigiendo a eliminar_habitacion.php?id=" + id);
                      window.location.href = 'eliminar_habitacion.php?id=' + id; 
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