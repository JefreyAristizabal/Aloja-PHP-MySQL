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

$sql6 = "SELECT * FROM tarifa";
$res6 = $conn->query($sql6);
?>

<div class="container-fluid">
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