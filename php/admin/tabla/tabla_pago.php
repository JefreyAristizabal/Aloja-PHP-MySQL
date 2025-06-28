<?php
session_start();

if (!isset($_SESSION['logged_in']) && isset($_COOKIE['logged_in']) && $_COOKIE['logged_in']) {
    $_SESSION['usuario'] = $_COOKIE['usuario'] ?? '';
    $_SESSION['rol'] = $_COOKIE['rol'] ?? '';
    $_SESSION['logged_in'] = true;
    $_SESSION['idEmpleado'] = $_COOKIE['idEmpleado'] ?? '';
    $_SESSION['nombre_completo'] = $_COOKIE['nombre_completo'] ?? '';
}

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] || $_SESSION['rol'] !== 'ADMIN') {
  header("Location: ../html/log-in.html");
  exit();
}

include_once '../../../config/conection.php';
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
                  <th class="no-export">Acción<span class="invisible">.................</span></th>
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
                          <td>
                            <a href="#" 
                               class="btn btn-link text-decoration-underline text-primary p-0" 
                               data-bs-toggle="modal" 
                               data-bs-target="#imagenModal" 
                               data-img="/php/<?= htmlspecialchars($row['Imagen']) ?>">
                               Ver Imagen
                            </a>
                          </td>

                         <td><?= $row['Observacion'] ?></td>
                         <div class="d-flex justify-content-center gap-1">
                             <td class="text-center no-export">
                             <a href="?section=editar/editar_pago&id=<?= $row['idPagos'] ?>" class="btn btn-success">Editar</a>
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
                  <th class="no-export">Acción</th>
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
                      window.location.href = './eliminar/eliminar_pago.php?id=' + id; 
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
<!-- Modal para mostrar imagen -->
<div class="modal fade" id="imagenModal" tabindex="-1" aria-labelledby="imagenModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imagenModalLabel">Imagen del Pago</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body text-center">
        <img id="imagenModalSrc" src="" class="img-fluid rounded" alt="Comprobante">
      </div>
    </div>
  </div>
</div>
<div class="d-flex justify-content-end align-items-center gap-2 mb-3 mx-3">
  <select id="tipo-exportacion" class="form-select w-auto">
    <option value="pdf">PDF</option>
    <option value="excel">Excel</option>
    <option value="csv">CSV</option>
  </select>
  <button id="btn-exportar" class="btn btn-primary">
    <i class="bi bi-download me-1"></i>Exportar
  </button>
</div>
<script>
  const imagenModal = document.getElementById('imagenModal');

  imagenModal.addEventListener('show.bs.modal', function (event) {
    const triggerLink = event.relatedTarget;
    const imageUrl = triggerLink.getAttribute('data-img');
    const modalImg = document.getElementById('imagenModalSrc');

    if (imageUrl && modalImg) {
      modalImg.src = imageUrl;
      console.log("Cargando imagen:", imageUrl);
    } else {
      console.warn("No se pudo cargar la imagen en el modal.");
    }
  });
</script>


