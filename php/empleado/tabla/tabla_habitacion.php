<?php
session_start();

if (!isset($_SESSION['logged_in']) && isset($_COOKIE['logged_in']) && $_COOKIE['logged_in']) {
    $_SESSION['usuario'] = $_COOKIE['usuario'] ?? '';
    $_SESSION['rol'] = $_COOKIE['rol'] ?? '';
    $_SESSION['logged_in'] = true;
    $_SESSION['idEmpleado'] = $_COOKIE['idEmpleado'] ?? '';
    $_SESSION['nombre_completo'] = $_COOKIE['nombre_completo'] ?? '';
}

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] || $_SESSION['rol'] !== 'EMPLEADO') {
  header("Location: ../html/log-in.html");
  exit();
}

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
                  <th class="no-export">Acción</th>
                </tr>
              </thead>
              <tbody>
                <?php while($row = $res5->fetch_assoc()): ?>
                     <tr>
                         <td><?=  $row['idHABITACION']?></td>
                         <td><?= $row['NOMBRE']?></td>
                         <td><?= $row['CAPACIDAD']?></td>
                         <td><?= $row['DESCRIPCION']?></td>
                          <td>
                            <a href="#" 
                               class="btn btn-link text-decoration-underline text-primary p-0" 
                               data-bs-toggle="modal" 
                               data-bs-target="#imagenModal" 
                               data-img="/php/<?= htmlspecialchars($row['IMAGEN']) ?>">
                               Ver Imagen
                            </a>
                          </td>
                         <div class="d-flex justify-content-center gap-1">
                             <td class="text-center no-export">
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
                  <th class="no-export">Acción<span class="invisible">........................</span></th>
                </tr>
              </tfoot>
            </table>
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
        <h5 class="modal-title" id="imagenModalLabel">Imagen de la Habitación</h5>
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