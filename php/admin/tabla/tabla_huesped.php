<?php
include_once '../../../config/conection.php';
$conn = conectarDB();

$sql2 = "SELECT * FROM huesped";
$res2 = $conn->query($sql2);
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="card">
        <div class="card-header">
          <span><i class="bi bi-table me-2"></i></span> Huespedes
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
                  <th>Nombre Completo</th>
                  <th>Tipo de Documento</th>
                  <th>Número de Documento</th>
                  <th>Teléfono de Huesped</th>
                  <th>Origen</th>
                  <th>Nombre de Contacto</th>
                  <th>Teléfono de Contacto</th>
                  <th>Observaciones</th>
                  <th>Otras Observaciones</th>
                  <th>Acción<span class="invisible">...........................</span></th>
                </tr>
              </thead>
              <tbody>
                <?php while($row = $res2->fetch_assoc()): ?>
                     <tr>
                         <td><?=  $row['idHUESPED']?></td>
                         <td><?= $row['Nombre_completo']?></td>
                         <td><?= $row['tipo_documento']?></td>
                         <td><?= $row['numero_documento']?></td>
                         <td><?= $row['Telefono_huesped']?></td>
                         <td><?= $row['Origen']?></td>
                         <td><?= $row['Nombre_Contacto']?></td>
                         <td><?= $row['Telefono_contacto']?></td>
                         <td><?= $row['Observaciones']?></td>
                         <td><?= $row['observaciones2']?></td>
                         <div class="d-flex justify-content-center gap-1">
                             <td class="text-center">
                             <a href="?section=editar/editar_huesped&id=<?= $row['idHUESPED'] ?>" class="btn btn-success">Editar</a>
                             <a class="btn btn-danger" href="#" onclick="confirmarEliminacion(<?= ($row['idHUESPED']) ?>)">Eliminar</a>
                             </td>
                         </div>                        
                     </tr>
                <?php  endwhile; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>ID de Huesped</th>
                  <th>Nombre Completo</th>
                  <th>Tipo de Documento</th>
                  <th>Número de Documento</th>
                  <th>Teléfono de Huesped</th>
                  <th>Origen</th>
                  <th>Nombre de Contacto</th>
                  <th>Teléfono de Contacto</th>
                  <th>Observaciones</th>
                  <th>Otras Observaciones</th>
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
                      console.log("Redirigiendo a eliminar_huesped.php?id=" + id);
                      window.location.href = './eliminar/eliminar_huesped.php?id=' + id; 
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