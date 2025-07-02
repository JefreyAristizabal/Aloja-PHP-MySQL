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
  header("Location: ../../../html/log-in.html");
  exit();
}
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="card">
        <div class="card-header">
          <span><i class="bi bi-pen me-2"></i></span> Editar Huésped
        </div>
        <div class="card-body">
          <?php 
            include_once '../../../config/conection.php';
            $conn = conectarDB();

            $id = $_GET['id'] ?? null;

            if ($id) {
                $sql = "SELECT * FROM huesped WHERE idHUESPED = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $res = $stmt->get_result();
                $huesped = $res->fetch_assoc();
            } else {
                echo "No se ha proporcionado un ID de huésped.";
            }
          ?>

          <h2>Editar Huésped</h2>
          <form id="form-huesped" action="./actualizar/actualizar_huesped.php" method="post" enctype="multipart/form-data" novalidate>        
            <input type="hidden" name="id" value="<?= $huesped['idHUESPED']?>">

            <div class="form-floating my-3">
              <input type="text" name="nombre_huesped" id="nombre_huesped" class="form-control" value="<?= $huesped['Nombre_completo']?>" required>
              <label for="nombre_huesped">Nombre completo</label>
              <div class="valid-feedback">Nombre válido.</div>
              <div class="invalid-feedback">Debe tener al menos 3 caracteres.</div>
            </div>

            <div class="input-group mb-3">
              <label class="input-group-text" for="tipodocumento">Tipo de documento</label>
              <select class="form-select" id="tipodocumento" name="tipodocumento" required>
                <option disabled <?= empty($huesped['tipo_documento']) ? 'selected' : '' ?>>Selecciona una opción</option>
                <option value="tarjeta" <?= $huesped['tipo_documento'] == 'tarjeta' ? 'selected' : '' ?>>TI</option>
                <option value="cedula" <?= $huesped['tipo_documento'] == 'cedula' ? 'selected' : '' ?>>Cédula de ciudadanía</option>
                <option value="otros" <?= $huesped['tipo_documento'] == 'otros' ? 'selected' : '' ?>>Otro</option>
              </select>
              <div class="valid-feedback ms-3">Tipo válido.</div>
              <div class="invalid-feedback ms-3">Selecciona un tipo de documento.</div>
            </div>

            <div class="form-floating my-3">
              <input type="text" name="numero_documento_huesped" id="numero_documento_huesped" class="form-control" value="<?= $huesped['numero_documento']?>" required>
              <label for="numero_documento_huesped">Número de documento</label>
              <div class="valid-feedback">Número válido.</div>
              <div class="invalid-feedback">Debe tener entre 6 y 15 dígitos numéricos.</div>
            </div>

            <div class="form-floating my-3">
              <input class="form-control" type="text" name="telefono_huesped" id="telefono_huesped" value="<?= $huesped['Telefono_huesped']?>" required>
              <label for="telefono_huesped">Teléfono</label>
              <div class="valid-feedback">Teléfono válido.</div>
              <div class="invalid-feedback">Debe contener 7 a 15 dígitos numéricos.</div>
            </div>

            <div class="form-floating my-3">
              <input type="text" name="ciudad_huesped" id="ciudad_huesped" class="form-control" value="<?= $huesped['Origen']?>" required>
              <label for="ciudad_huesped">Ciudad</label>
              <div class="valid-feedback">Ciudad válida.</div>
              <div class="invalid-feedback">Debe tener al menos 3 letras.</div>
            </div>

            <div class="form-floating my-3">
              <input class="form-control" type="text" name="nombre_contacto_huesped" id="nombre_contacto_huesped" value="<?= $huesped['Nombre_Contacto']?>">
              <label for="nombre_contacto_huesped">Nombre de contacto</label>
            </div>

            <div class="form-floating my-3">
              <input class="form-control" type="text" name="telefono_contacto_huesped" id="telefono_contacto_huesped" value="<?= $huesped['Telefono_contacto']?>">
              <label for="telefono_contacto_huesped">Teléfono de contacto</label>
            </div>

            <div class="input-group mb-3">
              <span class="input-group-text">Observaciones</span>
              <textarea class="form-control" name="observaciones_huesped" id="observaciones_huesped"><?= $huesped['Observaciones']?></textarea>
            </div>

            <div class="input-group mb-3">
              <span class="input-group-text">Otras Observaciones</span>
              <textarea class="form-control" name="otras_observaciones_huesped" id="otras_observaciones_huesped"><?= $huesped['observaciones2']?></textarea>
            </div>

            <button class="btn btn-primary">Actualizar</button>
          </form>

          <!-- Validación JS -->
          <script>
            const form = document.getElementById('formReserva');

            function validarCampoTexto(id, min = 1) {
              const input = document.getElementById(id);
              const valido = input.value.trim().length >= min;
              actualizarFeedback(input, valido);
            }
          
            function validarTelefono(id) {
              const input = document.getElementById(id);
              const regex = /^\d{7,}$/;
              const valido = regex.test(input.value.trim());
              actualizarFeedback(input, valido);
            }
          
            function validarSelect(id) {
              const select = document.getElementById(id);
              const valido = select.value !== '';
              actualizarFeedback(select, valido);
            }
          
            function actualizarFeedback(input, valido) {
              const parent = input.closest('.form-floating') || input.closest('.input-group');
              const valid = parent.querySelector('.valid-feedback');
              const invalid = parent.querySelector('.invalid-feedback');
            
              if (valido) {
                input.classList.add('is-valid');
                input.classList.remove('is-invalid');
                if (valid) valid.classList.replace('d-none', 'd-block');
                if (invalid) invalid.classList.replace('d-block', 'd-none');
              } else {
                input.classList.add('is-invalid');
                input.classList.remove('is-valid');
                if (invalid) invalid.classList.replace('d-none', 'd-block');
                if (valid) valid.classList.replace('d-block', 'd-none');
              }
            }
          
            // Validar opcional: si está vacío no marca error, si tiene algo se valida
            function validarCampoTextoOpcional(id, min = 1) {
              const input = document.getElementById(id);
              const valor = input.value.trim();
              if (valor === '') {
                input.classList.remove('is-valid', 'is-invalid');
                return;
              }
              validarCampoTexto(id, min);
            }
          
            function validarTelefonoOpcional(id) {
              const input = document.getElementById(id);
              const valor = input.value.trim();
              if (valor === '') {
                input.classList.remove('is-valid', 'is-invalid');
                return;
              }
              validarTelefono(id);
            }
          
            // Eventos de campos obligatorios
            document.getElementById('nombre_huesped').addEventListener('input', () => validarCampoTexto('nombre_huesped', 3));
            document.getElementById('numero_documento_huesped').addEventListener('input', () => validarCampoTexto('numero_documento_huesped', 5));
            document.getElementById('telefono_huesped').addEventListener('input', () => validarTelefono('telefono_huesped'));
            document.getElementById('tipodocumento').addEventListener('change', () => validarSelect('tipodocumento'));
          
            // Eventos de campos opcionales
            document.getElementById('ciudad_huesped').addEventListener('input', () => validarCampoTextoOpcional('ciudad_huesped', 2));
            document.getElementById('nombre_contacto_huesped').addEventListener('input', () => validarCampoTextoOpcional('nombre_contacto_huesped', 3));
            document.getElementById('telefono_contacto_huesped').addEventListener('input', () => validarTelefonoOpcional('telefono_contacto_huesped'));
          
            // Validación al enviar
            form.addEventListener('submit', function (e) {
              validarCampoTexto('nombre_huesped', 3);
              validarCampoTexto('numero_documento_huesped', 5);
              validarTelefono('telefono_huesped');
              validarSelect('tipodocumento');
            
              validarCampoTextoOpcional('ciudad_huesped', 2);
              validarCampoTextoOpcional('nombre_contacto_huesped', 3);
              validarTelefonoOpcional('telefono_contacto_huesped');
            
              if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
              }
            });
          </script>
        </div>
      </div>
    </div>
  </div>
</div>
