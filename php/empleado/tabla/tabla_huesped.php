<?php
session_start();

if (!isset($_SESSION['logged_in']) || isset($_COOKIE['logged_in']) && $_COOKIE['logged_in']) {
    $_SESSION['usuario'] = $_COOKIE['usuario'] ?? '';
    $_SESSION['rol'] = $_COOKIE['rol'] ?? '';
    $_SESSION['logged_in'] = true;
    $_SESSION['idEmpleado'] = $_COOKIE['idEmpleado'] ?? '';
    $_SESSION['nombre_completo'] = $_COOKIE['nombre_completo'] ?? '';
}

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] || $_SESSION['rol'] !== 'EMPLEADO') {
  header("Location: ../../../html/log-in.html");
  exit();
}

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
                  <th class="no-export">Acción<span class="invisible">...........................</span></th>
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
                             <td class="text-center no-export">
                             <a href="?section=editar/editar_huesped&id=<?= $row['idHUESPED'] ?>" class="btn btn-success">Editar</a>
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
                  <th class="no-export">Acción</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
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