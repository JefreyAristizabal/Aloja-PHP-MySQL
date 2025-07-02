<?php
session_start();

if (!isset($_SESSION['logged_in']) || isset($_COOKIE['logged_in']) && $_COOKIE['logged_in']) {
    $_SESSION['usuario'] = $_COOKIE['usuario'] ?? '';
    $_SESSION['rol'] = $_COOKIE['rol'] ?? '';
    $_SESSION['logged_in'] = true;
    $_SESSION['idEmpleado'] = $_COOKIE['idEmpleado'] ?? '';
    $_SESSION['nombre_completo'] = $_COOKIE['nombre_completo'] ?? '';
}

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] || $_SESSION['rol'] !== 'ADMIN') {
  header("Location: ../../html/log-in.html");
  exit();
}


include_once '../../config/conection.php';
$conn = conectarDB();

$sql1 = "SELECT * FROM estadia";
$res1 = $conn->query($sql1);

$sql2 = "SELECT * FROM huesped";
$res2 = $conn->query($sql2);

$sql3 = "SELECT * FROM huesped_has_estadia";
$res3 = $conn->query($sql3);

$sql4 = "SELECT * FROM empleado";
$res4 = $conn->query($sql4);

$sql5 = "SELECT * FROM habitacion";
$res5 = $conn->query($sql5);

$sql6 = "SELECT * FROM tarifa";
$res6 = $conn->query($sql6);

$sql7 = "SELECT * FROM pagos";
$res7 = $conn->query($sql7);

$nombreMes = date('F'); // Nombre del mes actual en inglés (puedes traducirlo si lo deseas)

// Estadías totales y del mes
$totalEstadias = $conn->query("SELECT COUNT(*) as total FROM estadia")->fetch_assoc()['total'];
$estadiasMes = $conn->query("SELECT COUNT(*) as total FROM estadia WHERE MONTH(Fecha_Registro) = MONTH(CURRENT_DATE()) AND YEAR(Fecha_Registro) = YEAR(CURRENT_DATE())")->fetch_assoc()['total'];

// Pagos totales y del mes
$totalPagos = $conn->query("SELECT COUNT(*) as total FROM pagos")->fetch_assoc()['total'];
$pagosMes = $conn->query("SELECT COUNT(*) as total FROM pagos WHERE MONTH(Fecha_Pago) = MONTH(CURRENT_DATE()) AND YEAR(Fecha_Pago) = YEAR(CURRENT_DATE())")->fetch_assoc()['total'];

$fecha = new DateTime();
$formatter = new IntlDateFormatter('es_ES', IntlDateFormatter::LONG, IntlDateFormatter::NONE, null, null, 'LLLL');
$nombreMes = ucfirst($formatter->format($fecha));


?>  
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h4>Panel</h4>
      </div>
    </div>
    <div class="row">

      <!-- Estadías Totales -->
      <div class="col-md-3 mb-3">
        <div class="card bg-primary text-white h-100" style="min-height: 160px;">
          <div class="card-body py-3">
            <h6 class="card-title mb-3">Estadías Totales</h6>
            <p class="card-text fs-4"><?= $totalEstadias ?></p>
          </div>
          <div class="card-footer text-center py-2">
            <a href="?section=tabla/tabla_estadia" class="text-white text-decoration-none">
              Ver Estadías <i class="bi bi-chevron-right ms-1"></i>
            </a>
          </div>
        </div>
      </div>

      <!-- Estadías del mes actual -->
      <div class="col-md-3 mb-3">
        <div class="card bg-info text-white h-100" style="min-height: 160px;">
          <div class="card-body py-3">
            <h6 class="card-title mb-3">Estadías en <?= $nombreMes ?></h6>
            <p class="card-text fs-4"><?= $estadiasMes ?></p>
          </div>
          <div class="card-footer text-center py-2">
            <a href="?section=tabla/tabla_estadia" class="text-white text-decoration-none">
              Ver Estadías <i class="bi bi-chevron-right ms-1"></i>
            </a>
          </div>
        </div>
      </div>

      <!-- Pagos Totales -->
      <div class="col-md-3 mb-3">
        <div class="card bg-success text-white h-100" style="min-height: 160px;">
          <div class="card-body py-3">
            <h6 class="card-title mb-3">Pagos Totales</h6>
            <p class="card-text fs-4"><?= $totalPagos ?></p>
          </div>
          <div class="card-footer text-center py-2">
            <a href="?section=tabla/tabla_pago" class="text-white text-decoration-none">
              Ver Pagos <i class="bi bi-chevron-right ms-1"></i>
            </a>
          </div>
        </div>
      </div>

      <!-- Pagos del mes actual -->
      <div class="col-md-3 mb-3">
        <div class="card bg-warning text-dark h-100" style="min-height: 160px;">
          <div class="card-body py-3">
            <h6 class="card-title mb-3">Pagos en <?= $nombreMes ?></h6>
            <p class="card-text fs-4"><?= $pagosMes ?></p>
          </div>
          <div class="card-footer text-center py-2">
            <a href="?section=tabla/tabla_pago" class="text-white text-decoration-none">
              Ver Pagos <i class="bi bi-chevron-right ms-1"></i>
            </a>
          </div>
        </div>
      </div>

    </div>



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
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
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
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
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
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
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
  <div class="modal-dialog modal-dialog-centered modal-sm">
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