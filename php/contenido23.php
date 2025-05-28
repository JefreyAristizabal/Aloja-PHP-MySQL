<?php
include_once '../config/conection.php';
$conn = conectarDB();

$sql8 = "SELECT * FROM novedades";
$res8 = $conn->query($sql8);
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="card">
        <div class="card-header">
          <span><i class="bi bi-table me-2"></i></span> Novedades
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
                  <th>ID de Novedad</th>
                  <th>Descripción</th>
                  <th>ID de Estadía</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>
                <?php while($row = $res8->fetch_assoc()): ?>
                     <tr>
                         <td><?=  $row['idNovedades']?></td>
                         <td><?= $row['Descripcion']?></td>
                         <td><?= $row['Estadia_idEstadia']?></td>
                         <div class="d-flex justify-content-center gap-1">
                             <td class="text-center ">
                             <a href="#" class="btn btn-success btn-editar-novedad" data-id="<?= $row['idNovedades'] ?>">Editar</a>
                             <a class="btn btn-danger" href="#" onclick="confirmarEliminacion(<?= ($row['idNovedades']) ?>)">Eliminar</a>
                             </td>
                         </div>                        
                     </tr>
                <?php  endwhile; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>ID de Novedad</th>
                  <th>Descripción</th>
                  <th>ID de Estadía</th>
                  <th>Acción</th>
                </tr>
              </tfoot>
            </table>
            <script>
                $(document).ready(function () {
                  $(document).on('click', '.btn-editar-novedad', function (e) {
                    e.preventDefault();

                    const idNovedad = $(this).data('id');

                    const $contenedor25 = $('#container25');

                    $contenedor25.removeClass('d-none').addClass('d-block');

                    for (let i = 1; i <= 25; i++) {
                      if (i !== 25) {
                        $('#container' + i).removeClass('d-block').addClass('d-none');
                      }
                    }
                
                    $contenedor25.load(`contenido25.php?id=${idNovedad}`);
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
                      console.log("Redirigiendo a eliminar_novedad.php?id=" + id);
                      window.location.href = 'eliminar_novedad.php?id=' + id; 
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