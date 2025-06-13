<?php
include_once '../../../config/conection.php';
$conn = conectarDB();

$sql4 = "SELECT * FROM empleado";
$res4 = $conn->query($sql4);
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="card">
        <div class="card-header">
          <span><i class="bi bi-table me-2"></i></span> Empleados
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
                  <th>ID de Empleado</th>
                  <th>Nombre Completo</th>
                  <th>Usuario</th>
                  <th>Contraseña</th>
                  <th>Rol</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>
                <?php while($row = $res4->fetch_assoc()): ?>
                     <tr>
                         <td><?=  $row['idEmpleado']?></td>
                         <td><?= $row['Nombre_Completo']?></td>
                         <td><?= $row['Usuario']?></td>
                         <td><?= $row['Password']?></td>
                         <td><?= $row['Rol']?></td>
                         <div class="d-flex justify-content-center gap-1">
                             <td class="text-center ">
                              <a href="?section=editar/editar_empleado&id=<?= $row['idEmpleado'] ?>" class="btn btn-success">Editar</a>
                             <a class="btn btn-danger" href="#" onclick="confirmarEliminacion(<?= ($row['idEmpleado']) ?>)">Eliminar</a>
                             </td>
                         </div>                        
                     </tr>
                <?php  endwhile; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>ID de Empleado</th>
                  <th>Nombre Completo</th>
                  <th>Usuario</th>
                  <th>Contraseña</th>
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
                      console.log("Redirigiendo a eliminar_empleado.php?id=" + id);
                      window.location.href = './eliminar/eliminar_empleado.php?id=' + id; 
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