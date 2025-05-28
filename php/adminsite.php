<?php
session_start();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
  header("Location: ../html/log-in.html");
  exit();
}
include '../config/conection.php';
$conn = conectarDB();
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
              <a href="?section=panel" class="nav-link px-3 active text-white">
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
                    <a href="?section=tabla_estadia" class="nav-link px-3 text-white">
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
                    <a href="#" class="nav-link px-3 text-white" id="link21">
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
                data-bs-toggle="collapse"
                href="#layouts-3"
              >
                <span class="me-2"><i class="bi bi-briefcase"></i></span>
                <span>Empleados</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="layouts-3">
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="?section=tabla_empleado" class="nav-link px-3 text-white">
                      <span class="me-2"
                        ><i class="bi bi-table"></i
                      ></span>
                      <span>Tabla de Empleados</span>
                    </a>
                  </li>
                  <li>
                    <a href="?section=agregar_empleado" class="nav-link px-3 text-white">
                      <span class="me-2"><i class="bi bi-plus"></i></span>
                      <span>Agregar Empleado</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li>
              <a
                class="nav-link px-3 sidebar-link text-white"
                data-bs-toggle="collapse"
                href="#layouts-4"
              >
                <span class="me-2"><i class="bi bi-house"></i></span>
                <span>Habitaciones</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="layouts-4">
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="#" class="nav-link px-3 text-white" id="link6">
                      <span class="me-2"
                        ><i class="bi bi-table"></i
                      ></span>
                      <span>Tabla de Habitaciones</span>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="nav-link px-3 text-white" id="link12">
                      <span class="me-2"><i class="bi bi-plus"></i></span>
                      <span>Agregar Habitación</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li>
              <a
                class="nav-link px-3 sidebar-link text-white"
                data-bs-toggle="collapse"
                href="#layouts-5"
              >
                <span class="me-2"><i class="bi bi-wallet"></i></span>
                <span>Tarifas</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="layouts-5">
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="#" class="nav-link px-3 text-white" id="link7">
                      <span class="me-2"
                        ><i class="bi bi-table"></i
                      ></span>
                      <span>Tabla de Tarifas</span>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="nav-link px-3 text-white" id="link13">
                      <span class="me-2"><i class="bi bi-plus"></i></span>
                      <span>Agregar Tarifa</span>
                    </a>
                  </li>
                </ul>
              </div>
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
                    <a href="?section=tabla_pago" class="nav-link px-3 text-white">
                      <span class="me-2"
                        ><i class="bi bi-table"></i
                      ></span>
                      <span>Tabla de Pagos</span>
                    </a>
                  </li>
                  <li>
                    <a href="?section=agregar_pago" class="nav-link px-3 text-white">
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
                    <a href="#" class="nav-link px-3 text-white" id="link23">
                      <span class="me-2"
                        ><i class="bi bi-table"></i
                      ></span>
                      <span>Tabla de Novedades</span>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="nav-link px-3 text-white" id="link24">
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
    <main class="mt-5 pt-3 d-none" id="contenido">
      <!--contenido.php-->
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
    <script src="../js/jquery-3.6.0.min.js"></script>
<script>
  function cargarContenido(section, id = null) {
    if (!section) section = 'panel'; // sección por defecto
    let url = `admin_${section}.php`;
    if (id) {
      url += `?id=${id}`;
    }

    // Oculta todos los main excepto #contenido
    $("main.mt-5.pt-3").addClass("d-none");
    $("#contenido").removeClass("d-none");

    // Carga el contenido dinámico
    $("#contenido").load(url, function() {
      // Inicializa DataTables si hay tablas con la clase .data-table
      if ($('.data-table').length) {
        $('.data-table').DataTable();
      }
    });
  }

  $(document).ready(function() {
    // Lee los parámetros de la URL
    const params = new URLSearchParams(window.location.search);
    const section = params.get('section');
    const id = params.get('id');
    cargarContenido(section, id);

    // Maneja clicks en los links del menú para navegación SPA
    $("a.nav-link").on("click", function(e) {
      const href = $(this).attr("href");
      if (href && href.startsWith("?section=")) {
        e.preventDefault();
        const urlParams = new URLSearchParams(href.split('?')[1]);
        const nuevaSection = urlParams.get('section');
        const nuevoId = urlParams.get('id');
        history.pushState({}, '', href);
        cargarContenido(nuevaSection, nuevoId);
      }
    });

    // Soporte para navegación con el botón atrás/adelante del navegador
    window.onpopstate = function() {
      const params = new URLSearchParams(window.location.search);
      const section = params.get('section');
      const id = params.get('id');
      cargarContenido(section, id);
    };
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
