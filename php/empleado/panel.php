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

include_once '../../config/conection.php';
$conn = conectarDB();

$sql1 = "SELECT * FROM estadia";
$res1 = $conn->query($sql1);

$sql2 = "SELECT * FROM huesped";
$res2 = $conn->query($sql2);

$sql3 = "SELECT * FROM huesped_has_estadia";
$res3 = $conn->query($sql3);

$sql5 = "SELECT * FROM habitacion";
$res5 = $conn->query($sql5);

$sql6 = "SELECT * FROM tarifa";
$res6 = $conn->query($sql6);

$sql7 = "SELECT * FROM pagos";
$res7 = $conn->query($sql7);
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <h4>Panel</h4>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3 mb-3">
      <div class="card bg-primary text-white h-100">
        <div class="card-body py-5">Agregar Huesped</div>
        <div class="card-footer d-flex">
          Agregar +
          <span class="ms-auto">
            <i class="bi bi-chevron-right"></i>
          </span>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card bg-warning text-dark h-100">
        <div class="card-body py-5">Agregar Estadía</div>
        <div class="card-footer d-flex">
          Agregar +
          <span class="ms-auto">
            <i class="bi bi-chevron-right"></i>
          </span>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card bg-success text-white h-100">
        <div class="card-body py-5">Editar Estadía</div>
        <div class="card-footer d-flex">
          Editar<i class="bi bi-pen px-2"></i>
          <span class="ms-auto">
            <i class="bi bi-chevron-right"></i>
          </span>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card bg-danger text-white h-100">
        <div class="card-body py-5">Cancelar Estadía</div>
        <div class="card-footer d-flex">
          Cancelar -
          <span class="ms-auto">
            <i class="bi bi-chevron-right"></i>
          </span>
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
                         <td><?= $row['IMAGEN']?></td>                       
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