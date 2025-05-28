<?php
session_start();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
  header("Location: ../html/log-in.html");
  exit();
}

include_once '../config/conection.php';
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

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/bootstrap.min.adminsite.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="../css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="../css/adminsite.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">
    <title>Admin | Aloja</title>
  </head>
  <body>
    <!-- top navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#sidebar"
          aria-controls="offcanvasExample"
        >
          <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
        </button>
        <a
          class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold"
          style="position:absolute;"
          href="../index.php"
          ><img src="../img/logo.png" alt="" style="max-width:50px;"></a
        >
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#topNavBar"
          aria-controls="topNavBar"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="topNavBar">
          <form class="d-flex ms-auto my-3 my-lg-0">
            <div class="input-group">
            </div>
          </form>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle ms-2 text-white"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <i class="bi bi-person-fill"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Perfil</a></li>
                <li><a class="dropdown-item" href="#">Cambiar contraseña</a></li>
                <li>
                  <a class="dropdown-item" href="logout.php">Cerrar sesión</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- top navigation bar -->
    <!-- offcanvas -->
    <div
      class="offcanvas offcanvas-start sidebar-nav"
      tabindex="-1"
    >
      <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
          <ul class="navbar-nav">
            <li>
              <div class="small fw-bold text-uppercase px-3 text-white">
                Principal
              </div>
            </li>
            <li>
              <a href="#" class="nav-link px-3 active text-white" id="link1">
                <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                <span>Panel</span>
              </a>
            </li>
            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="text-white small fw-bold text-uppercase px-3 mb-3">
                Interface
              </div>
            </li>
            <li>
              <a
                class="nav-link px-3 sidebar-link text-white"
                data-bs-toggle="collapse"
                href="#layouts-1"
              >
                <span class="me-2"><i class="bi bi-book"></i></span>
                <span>Estadías</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="layouts-1">
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="#" class="nav-link px-3 text-white" id="link2">
                      <span class="me-2"
                        ><i class="bi bi-table"></i
                      ></span>
                      <span>Tabla de Estadias</span>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="nav-link px-3 text-white" id="link9">
                      <span class="me-2"><i class="bi bi-plus"></i></span>
                      <span>Agregar Estadía</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li>
              <a
                class="nav-link px-3 sidebar-link text-white"
                data-bs-toggle="collapse"
                href="#layouts-2"
              >
                <span class="me-2"><i class="bi bi-person"></i></span>
                <span>Huespedes</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="layouts-2">
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="#" class="nav-link px-3 text-white" id="link3">
                      <span class="me-2"
                        ><i class="bi bi-table"></i
                      ></span>
                      <span>Tabla de Huespedes</span>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="nav-link px-3 text-white" id="link10">
                      <span class="me-2"><i class="bi bi-plus"></i></span>
                      <span>Agregar Huesped</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li>
              <a
                class="nav-link px-3 sidebar-link text-white"
                data-bs-toggle="collapse"
                href="#layouts-7"
              >
                <span class="me-2"><i class="bi bi-file-earmark-spreadsheet"></i></span>
                <span>Huesped x Estadía</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="layouts-7">
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="#" class="nav-link px-3 text-white" id="link4">
                      <span class="me-2"
                        ><i class="bi bi-table"></i
                      ></span>
                      <span>Tabla de Huesped x Estadía</span>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="nav-link px-3 text-white" id="link11">
                      <span class="me-2"><i class="bi bi-plus"></i></span>
                      <span>Agregar Huesped x Estadía</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li>
              <a
                class="nav-link px-3 sidebar-link text-white"
                id="link5"
                href="#"
              >
                <span class="me-2"><i class="bi bi-table"></i></span>
                <span>Tabla de Habitaciones</span>
              </a>
            </li>
            <li>
              <a
                class="nav-link px-3 sidebar-link text-white"
                id="link6"
                href="#"
              >
                <span class="me-2"><i class="bi bi-table"></i></span>
                <span>Tabla de Tarifas</span>
              </a>
            </li>
            <li>
              <a
                class="nav-link px-3 sidebar-link text-white"
                data-bs-toggle="collapse"
                href="#layouts-6"
              >
                <span class="me-2"><i class="bi bi-cash"></i></span>
                <span>Pagos</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="layouts-6">
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="#" class="nav-link px-3 text-white" id="link7">
                      <span class="me-2"
                        ><i class="bi bi-table"></i
                      ></span>
                      <span>Tabla de Pagos</span>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="nav-link px-3 text-white" id="link12">
                      <span class="me-2"><i class="bi bi-plus"></i></span>
                      <span>Agregar Pago</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li>
              <a
                class="nav-link px-3 sidebar-link text-white"
                data-bs-toggle="collapse"
                href="#layouts-8"
              >
                <span class="me-2"><i class="bi bi-exclamation-circle"></i></span>
                <span>Novedades</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="layouts-8">
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="#" class="nav-link px-3 text-white" id="link8">
                      <span class="me-2"
                        ><i class="bi bi-table"></i
                      ></span>
                      <span>Tabla de Novedades</span>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="nav-link px-3 text-white" id="link13">
                      <span class="me-2"><i class="bi bi-plus"></i></span>
                      <span>Agregar Novedad</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- offcanvas -->
    <main class="mt-5 pt-3" id="container1">
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
                               <td><?= $row['Numero_documento']?></td>
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
    </main>
    <main class="mt-5 pt-3 d-none" id="container">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card">
              <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span> Agregar
              </div>
              <div class="card-body">
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <main class="mt-5 pt-3 d-none" id="container2">
      <!--Tabla Estadías-->
      <!--contenido_emp2.php-->
    </main>
    <main class="mt-5 pt-3 d-none" id="container3">
      <!--Tabla Huespedes-->
      <!--contenido_emp3.php-->
    </main>
    <main class="mt-5 pt-3 d-none" id="container4">
      <!--Tabla Huespedes x Estadía-->
      <!--contenido_emp4.php-->
    </main>
    <main class="mt-5 pt-3 d-none" id="container5">
      <!--Tabla Habitaciones-->
      <!--contenido_emp5.php-->
    </main>
    <main class="mt-5 pt-3 d-none" id="container6">
      <!--Tabla Tarifas-->
      <!--contenido_emp6.php-->
    </main>
    <main class="mt-5 pt-3 d-none" id="container7">
      <!--Tabla Pagos-->
      <!--contenido_emp7.php-->
    </main>
    <main class="mt-5 pt-3 d-none" id="container8">
      <!--Tabla Novedades-->
      <!--contenido_emp8.php-->
    </main>
    <main class="mt-5 pt-3 d-none" id="container9">
      <!--Agregar Estadía-->
      <!--contenido_emp9.php-->
    </main>
    <main class="mt-5 pt-3 d-none" id="container10">
      <!--Agregar Huesped-->
      <!--contenido_emp10.php-->
    </main>
    <main class="mt-5 pt-3 d-none" id="container11">
      <!--Agregar Huesped x Estadía-->
      <!--contenido_emp11.php-->
    </main>
    <main class="mt-5 pt-3 d-none" id="container12">
      <!--Agregar Pago-->
      <!--contenido_emp12.php-->
    </main>
    <main class="mt-5 pt-3 d-none" id="container13">
      <!--Agregar Novedad-->
      <!--contenido_emp13.php-->
    </main>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script>
      function mostrarContenedor(linkId, containerId) {
        $(`#${linkId}`).on('click', function(event) {
          event.preventDefault();
        
          const $contenedorActual = $(`#${containerId}`);
          const contenedorActivo = parseInt(containerId.replace("container", ""));
        
          $contenedorActual.removeClass("d-none").addClass("d-block");
        
          let url = `contenido_emp${contenedorActivo}.php`;

          if ([5].includes(contenedorActivo)) {
            const id = new URLSearchParams(window.location.search).get("id");
            if (id) {
              url += `?id=${id}`;
            }
          }
        
          $contenedorActual.load(url, function () {
            if (contenedorActivo !== 1) {
              $contenedorActual.find('.data-table').DataTable();
            }
          });
        
          for (let i = 1; i <= 13; i++) {
            if (i !== contenedorActivo) {
              const $otroContenedor = $(`#container${i}`);
              if ($otroContenedor.length) {
                $otroContenedor.removeClass("d-block").addClass("d-none");
              }
            }
          }
        });
      }

      $(document).ready(function() {
        for (let i = 1; i <= 13; i++) {
          if ($(`#link${i}`).length && $(`#container${i}`).length) {
            mostrarContenedor(`link${i}`, `container${i}`);
          }
        }
      
        const urlParams = new URLSearchParams(window.location.search);
        const idHabitacion = urlParams.get("id");
        if (idHabitacion) {
          $(`#link${idHabitacion}`).click();
        }
      });

    </script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery-3.5.1.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap5.min.js"></script>
    <script src="../js/adminsite.js"></script>
    <script src="../js/sweetalert2@11.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </body>
</html>
