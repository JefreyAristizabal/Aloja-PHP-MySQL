<?php
include_once '../config/conection.php';
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
                  <th>ID de Huesped</th>
                  <th>ID de Estadía</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>
                <?php while($row = $res3->fetch_assoc()): ?>
                     <tr>
                         <td><?=  $row['HUESPED_idHUESPED']?></td>
                         <td><?= $row['Estadia_idEstadia']?></td>
                         <div class="d-flex justify-content-center gap-1">
                             <td class="text-center">
                             <a href="#" class="btn btn-success btn-editar-huespedxestadia" data-idhuesped="<?= $row['Estadia_idEstadia'] ?>" data-idestadia="<?= $row['HUESPED_idHUESPED'] ?>">Editar</a>
                              <a class="btn btn-danger" href="#" onclick="confirmarEliminacion(<?= ($row['HUESPED_idHUESPED']) ?>, <?= $row['Estadia_idEstadia'] ?>)">Eliminar</a>
                             </td>
                         </div>                      
                     </tr>
                <?php  endwhile; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>ID de Huesped</th>
                  <th>ID de Estadía</th>
                  <th>Acción</th>
                </tr>
              </tfoot>
            </table>
            <script>
            $(document).ready(function () {
              $(document).on('click', '.btn-editar-huespedxestadia', function (e) {
                e.preventDefault();
              
                const idHuesped = $(this).data('idhuesped');
                const idEstadia = $(this).data('idestadia');
              
                const $contenedor22 = $('#container22');
              
                $contenedor22.removeClass('d-none').addClass('d-block');
              
                for (let i = 1; i <= 25; i++) {
                  if (i !== 22) {
                    $('#container' + i).removeClass('d-block').addClass('d-none');
                  }
                }
              
                $contenedor22.load(`contenido22.php?idhuesped=${idHuesped}&idestadia=${idEstadia}`, function(response, status, xhr) {
                  if (status === "error") {
                    console.error("Error al cargar contenido22.php:", xhr.status, xhr.statusText);
                    alert("Hubo un error al cargar el contenido.");
                  }
                });
              });
            });
            </script>
            <script>
                function confirmarEliminacion(id1, id2) {
                  Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡Esta acción no se puede deshacer!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar',
                  }).then((result) => {
                    if (result.isConfirmed) {
                      console.log("Redirigiendo a eliminar_huespedxestadia.php?idhuesped=" + id1 + "&idestadia=" + id2);
                      window.location.href = 'eliminar_huespedxestadia.php?idhuesped=' + id1 + '&idestadia=' + id2; 
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