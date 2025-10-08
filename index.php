<?php
$conn = mysqli_connect("localhost","root","","institucional");
if (!$conn) { die("Error conexión: " . mysqli_connect_error()); }
$avisos = mysqli_query($conn, "SELECT * FROM aviso ORDER BY id ASC");
?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>EPET N°20</title>

    <!-- Favicon -->
    <link rel="icon" href="img/favicon.png">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    
    <!-- Tu CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/carrusel.css">

    <style>
        /* Modal base */
        .custom-modal { display:none; position:fixed; z-index:2000; left:0; top:0; width:100%; height:100%; background:rgba(0,0,0,0.7); justify-content:center; align-items:center; }
        .modal-box { background:#fff; padding:20px; border-radius:12px; max-width:500px; width:100%; text-align:center; box-shadow:0 5px 15px rgba(0,0,0,0.3); }
        .btn-ok { background:#007bff; color:#fff; border:none; padding:8px 16px; border-radius:8px; cursor:pointer; }
        .btn-ok:hover { background:#0056b3; }
        /* Imagen en pantalla completa */
        #avisoModal.imagen-activa .modal-box { background:transparent; box-shadow:none; padding:0; max-width:90%; max-height:90%; }
        #avisoModal.imagen-activa img { max-width:100%; max-height:100%; border-radius:12px; display:block; margin:auto; }
        #avisoModal.imagen-activa .btn-cerrar-img { position:absolute; top:20px; right:20px; background:rgba(0,0,0,0.7); color:#fff; border:none; padding:10px 15px; border-radius:8px; cursor:pointer; font-size:16px; }
        #avisoModal.imagen-activa .btn-cerrar-img:hover { background:rgba(0,0,0,0.9); }
    </style>   
  </head>
  <body onload="mostrarMensaje()" translate="no">

  <!-- navbar -->

  <nav class="navbar bg-dark navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="img\school.svg" alt="logo inicio">
      EPET 20
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Inicio</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Estudiantes
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Docentes
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Biblioteca
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Institucion</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Taller
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Ed. física</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">ESI</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true"></a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <button class="btn btn-sm btn-outline-secondary" type="button" onclick="abrirLogin()">Login</button>
      </form>
    </div>
  </div>
</nav>

<!-- fin navbar -->

  <!-- Carrusel -->
  <section class="carousel" id="carousel" aria-label="Carrusel de imágenes">
    <div class="slides" id="slides">
      <?php
        $hasAny = false;
        while ($fila = mysqli_fetch_assoc($avisos)) {
          $hasAny = true;
          $img_desktop = !empty($fila['img_desktop']) ? htmlspecialchars($fila['img_desktop']) : 'https://images.unsplash.com/photo-1503264116251-35a269479413?q=80&w=2000&auto=format&fit=crop';
          $img_mobile  = !empty($fila['img_mobile'])  ? htmlspecialchars($fila['img_mobile'])  : 'https://images.unsplash.com/photo-1503264116251-35a269479413?q=80&w=1000&auto=format&fit=crop';
          $titulo = htmlspecialchars($fila['titulo']);
          $contenido = htmlspecialchars($fila['contenido']);
      ?>
        <article class="slide" role="group" aria-roledescription="slide">
          <picture>
            <source media="(min-width:1024px)" srcset="<?= $img_desktop ?>">
            <img src="<?= $img_mobile ?>" alt="<?= $titulo ?>">
          </picture>
          <div class="slide__content">
            <h3 class="slide__title"><?= $titulo ?></h3>
            <p class="slide__desc"><?= $contenido ?></p>
          </div>
        </article>
      <?php } ?>
      <?php if (!$hasAny) { ?>
        <article class="slide">
          <picture>
            <source media="(min-width:1024px)" srcset="https://images.unsplash.com/photo-1503264116251-35a269479413?q=80&w=2000&auto=format&fit=crop">
            <img src="https://images.unsplash.com/photo-1503264116251-35a269479413?q=80&w=1000&auto=format&fit=crop" alt="Imagen por defecto">
          </picture>
          <div class="slide__content">
            <h3 class="slide__title">No hay avisos</h3>
            <p class="slide__desc">Todavía no hay avisos cargados en la base de datos.</p>
          </div>
        </article>
      <?php } ?>
    </div>

    <button class="carousel__arrow carousel__arrow--prev" id="prev" aria-label="Anterior">
      <img src="img/izq.svg" alt="flecha izquierda">
    </button>
    <button class="carousel__arrow carousel__arrow--next" id="next" aria-label="Siguiente">
      <img src="img/der.svg" alt="flecha derecha">
    </button>
    <div class="carousel__dots" id="dots" role="tablist" aria-hidden="false"></div>
  </section>

  <!-- Main -->
  <main id="mainInfo" role="main" aria-labelledby="mainTitle">

    <div class="intro">
      <h2 id="mainTitle">Escuela Provincial de Educación Técnica Nº 20</h2>
      <p>Somos una institución comprometida con la formación técnica y profesional.</p>
    </div>
    <div class="cards" aria-live="polite">
      <article class="card" role="region" aria-labelledby="misionTitle">
        <h3 id="misionTitle">Misión</h3>
        <p>Formar recursos humanos con capacidades técnicas y éticas, preparados para insertarse en el mundo productivo y académico.</p>
      </article>
      <article class="card" role="region" aria-labelledby="visionTitle">
        <h3 id="visionTitle">Visión</h3>
        <p>Ser referentes regionales en educación técnica, promoviendo la innovación y el desarrollo sustentable.</p>
      </article>
      <article class="card" role="region" aria-labelledby="valoresTitle">
        <h3 id="valoresTitle">Valores</h3>
        <p>Responsabilidad, trabajo en equipo, creatividad y compromiso con la comunidad.</p>
      </article>
    </div>

  </main>

  <!-- Footer -->
  <footer id="siteFooter" role="contentinfo">
    <div class="footer-inner">
      <div class="contact" aria-label="Información de contacto">
        <div>
          <strong>Dirección</strong>
          <div class="small">
            <a class="enlace" href="https://maps.app.goo.gl/7r9AdiSzANaFCoyT9" target="_blank">Neuquén, Lanin 2020</a>
          </div>
        </div>
        <div>
          <strong>Teléfono</strong>
          <div class="small">(299) 447-8052</div>
        </div>
        <div>
          <strong>Email</strong>
          <div class="small">
            <a class="enlace" href="mailto:epet020@neuquen.edu.ar">epet020@neuquen.edu.ar</a>
          </div>
        </div>
      </div>
      <div class="small" style="margin-top:1rem;">© <?= date('Y') ?> Instituto de Educación Técnica Nº 20 — Todos los derechos reservados</div>
    </div>
  </footer>

  <!--Fin footer-->

  <!-- Inicio LOGIN-->

  <!-- Modal Login -->
  <div id="loginModal" class="custom-modal">
    <div class="modal-box">
      <h4>Acceso Administrador</h4>
      <!-- Form: ahora hace POST al mismo archivo -->
      <form method="POST" action="">
        <input type="hidden" name="accion" value="login">
        <input type="text" name="usuario" placeholder="Usuario" class="form-control mb-2" required>
        <input type="password" name="password" placeholder="Contraseña" class="form-control mb-2" required>
        <button type="submit" class="btn btn-primary">Ingresar</button>
        <button type="button" class="btn btn-secondary" onclick="cerrarLogin()">Cancelar</button>
      </form>
    </div>
  </div>

  <!-- Modal Acceso (publicar novedad) -->
  <div id="accesoModal" class="custom-modal">
    <div class="modal-box">
      <h4>Publicar Novedad</h4>
      <textarea id="mensaje" class="form-control mb-2" placeholder="Escribe un mensaje..."></textarea>
      <input type="file" id="archivo" accept="image/*" class="form-control mb-3">
      <div class="d-flex flex-wrap gap-2 justify-content-center">
        <button type="button" class="btn btn-primary" onclick="guardarMensaje()">Guardar</button>
        <button type="button" class="btn btn-warning" onclick="editarMensaje()">Editar</button>
        <button type="button" class="btn btn-danger" onclick="eliminarMensaje()">Eliminar</button>
        <button type="button" class="btn btn-secondary" onclick="cerrarAcceso()">Cerrar</button>
      </div>
      <div class="form-text mt-2">Esta edición afecta lo que ve el público al entrar al sitio.</div>
    </div>
  </div>

  <!-- Modal Aviso Público -->
  <div id="avisoModal" class="custom-modal">
    <div class="modal-box" id="avisoBox">
      <h4 id="avisoTitulo">Aviso Importante</h4>
      <p id="avisoTexto"></p>
      <div id="avisoBotonera" class="mt-3 d-flex justify-content-center">
        <button class="btn-ok" onclick="cerrarAviso()">Cerrar</button>
      </div>
    </div>
  </div>

  <!-- FIN LOGIN-->

  <script src="js/carrusel.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  
<script>
//login
  window.__ADMIN_LOGGED__ = false;
    window.__LOGIN_ERROR__  = null;

  // Abrir / cerrar modales
    function abrirLogin(){ document.getElementById('loginModal').style.display = 'flex'; }
    function cerrarLogin(){ document.getElementById('loginModal').style.display = 'none'; }
    function cerrarAcceso(){ document.getElementById('accesoModal').style.display = 'none'; }
    function cerrarAviso(){ document.getElementById('avisoModal').style.display = 'none'; }

    // Mostrar estado de login al cargar
    (function(){
      if (window.__LOGIN_ERROR__) {
        abrirLogin();
        setTimeout(() => alert(window.__LOGIN_ERROR__), 10);
      }
      if (window.__ADMIN_LOGGED__) {
        // Abrir el modal de publicación para el admin que acaba de loguear
        document.getElementById('accesoModal').style.display = 'flex';
      }
    })();

    // Guardar novedad (texto o imagen) en localStorage
    function guardarMensaje(){
      const mensaje = document.getElementById('mensaje').value.trim();
      const archivo = document.getElementById('archivo').files[0];

      if (archivo) {
        const reader = new FileReader();
        reader.onload = function(e){
          localStorage.setItem('mensajePublico', e.target.result);
          localStorage.setItem('tipoMensaje', 'imagen');
          alert('Imagen publicada con éxito.');
        };
        reader.readAsDataURL(archivo);
      } else if (mensaje) {
        localStorage.setItem('mensajePublico', mensaje);
        localStorage.setItem('tipoMensaje', 'texto');
        alert('Mensaje publicado con éxito.');
      } else {
        alert('Por favor ingresa un mensaje o selecciona una imagen.');
      }
    }

    // Editar novedad (sólo texto rellena el textarea)
    function editarMensaje(){
      const tipo = localStorage.getItem('tipoMensaje');
      const msg  = localStorage.getItem('mensajePublico');
      if (!msg) { alert('No hay ninguna novedad publicada para editar.'); return; }
      if (tipo === 'texto') {
        document.getElementById('mensaje').value = msg;
      } else if (tipo === 'imagen') {
        alert('Actualmente hay una imagen publicada. Para reemplazarla, sube una nueva imagen y presiona "Guardar".');
      }
    }

    // Eliminar novedad
    function eliminarMensaje(){
      localStorage.removeItem('mensajePublico');
      localStorage.removeItem('tipoMensaje');
      alert('La novedad fue eliminada y ya no se mostrará.');
    }

    // Mostrar novedad al entrar (público)
    function mostrarMensaje(){
      const msg  = localStorage.getItem('mensajePublico');
      const tipo = localStorage.getItem('tipoMensaje');
      if (msg) {
        const avisoModal   = document.getElementById('avisoModal');
        const avisoTexto   = document.getElementById('avisoTexto');
        const avisoTitulo  = document.getElementById('avisoTitulo');
        const avisoBotonera= document.getElementById('avisoBotonera');

        if (tipo === 'imagen') {
          avisoModal.classList.add('imagen-activa');
          avisoTitulo.style.display = 'none';
          avisoBotonera.innerHTML = '<button class="btn-cerrar-img" onclick="cerrarAviso()">X</button>' +
                                    '<a class="btn btn-ok ms-2" target="_blank" href="'+ msg +'">Abrir en pestaña</a>';
          avisoTexto.innerHTML = '<img src="'+ msg +'" alt="Aviso">';
        } else {
          avisoModal.classList.remove('imagen-activa');
          avisoTitulo.style.display = 'block';
          avisoBotonera.innerHTML = '<button class="btn-ok" onclick="cerrarAviso()">Cerrar</button>';
          avisoTexto.textContent = msg;
        }
        avisoModal.style.display = 'flex';
      }
    }

  </script>
        
</html>
