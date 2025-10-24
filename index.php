<?php
$conn = mysqli_connect("localhost","root","","institucional");
if (!$conn) { die("Error conexión: " . mysqli_connect_error()); }
$avisos = mysqli_query($conn, "SELECT * FROM aviso ORDER BY fecha    LIMIT 5");
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
    <link rel="stylesheet" href="css/carrusel.css">
    <link rel="stylesheet" href="css/style.css">   
  </head>
  <body onload="mostrarMensaje()" translate="no" class="page-index">

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
            <li><a class="dropdown-item" target="_blank"  href="https://drive.google.com/drive/u/0/folders/14ZKnbClO4u6owrsoIQl_7Df9rJZWzeA4">Cuadernillos 2025</a></li>
            <li><a class="dropdown-item" target="_blank"  href="https://drive.google.com/drive/folders/1Ivw5xQGpYSQ8k8avcprrLHbtYpDQa-Fs">Cuadernillo ingresantes 2025</a></li>
            <li><a class="dropdown-item" target="_blank"  href="https://drive.google.com/file/d/1fot8S-KTKCtPb2BJoLwcMcuCrr15q5iB/view">Horarios clases de consulta</a></li>
            <li><a class="dropdown-item" target="_blank"  href="documentos.html">Documentación estudiantes</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" target="_blank"  href="https://drive.google.com/drive/folders/176F8SI_AKii_QPk0ZEPOqIwVLWGL5b-t">Programas previos/libres/equivalentes</a></li>
            <li><a class="dropdown-item" target="_blank"  href="https://drive.google.com/drive/u/0/folders/1gRXFqzjgzXU1VftigoT4Oocil5__rprR">Programas 2020</a></li>
            <li><a class="dropdown-item" target="_blank"  href="https://drive.google.com/drive/folders/1YRqfjHC2foMAHvoHTfznL7h5JPopRoYR">Fortalecimiento Oct. 2025</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Docentes
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" target="_blank"  href="https://drive.google.com/drive/folders/1yYFvkvTZolkhj7nEc3YOymVOEFvXYbhb">Preceptores por curso</a></li>
            <li><a class="dropdown-item" target="_blank"  href="docentes.html">Documentación docentes</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="biblioteca.html">Biblioteca</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Institución
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="autoridades.html">Autoridades</a></li>
            <li><a class="dropdown-item" href="asesoria.html">Asesoría</a></li>
            <li><a class="dropdown-item" href="secretaria.html">Secretaría</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" target="_blank" href="https://drive.google.com/drive/folders/1m52isQx2tvcDFPQyAYFKWYYGfNyDOkiQ">Taller</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" target="_blank" href="https://drive.google.com/drive/u/0/folders/1U1wsIHT1J_9szuHrpPf9YePeE_DiGHWN">Ed. física</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" target="_blank" href="https://drive.google.com/drive/u/0/folders/1A14Bjihlx9Xex8QW_s_qgIv5fD76GPOu">ESI</a>
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
          $img_desktop = !empty($fila['img_desktop']) ? htmlspecialchars($fila['img_desktop']) : 'img/fondo.png';
          $img_mobile  = !empty($fila['img_mobile'])  ? htmlspecialchars($fila['img_mobile'])  : 'img/fondo1.png';
          
          $titulo = htmlspecialchars($fila['titulo']);
          $fecha= htmlspecialchars($fila['fecha']);
          $fecha = date("d-m-y", strtotime($fecha));
          $contenido = htmlspecialchars($fila['contenido']);
      ?>
        <article class="slide" role="group" aria-roledescription="slide">
          <picture>
            <source media="(min-width:1024px)" srcset="<?= $img_desktop ?>">
            <img src="<?= $img_mobile ?>" alt="<?= $titulo ?>">
          </picture>
          <div class="slide__content">
            <h3 class="slide__title"><?= $titulo ?></h3>
            <p class="slide__desc">Fecha: <?= $fecha ?></p>
            <p class="slide__desc"><?= $contenido ?></p>
          </div>
        </article>
      <?php } ?>
      <?php if (!$hasAny) { ?>
        <article class="slide">
          <picture>
            <source media="(min-width:1024px)" srcset="img/fondo.png">
            <img src="img/fondo.png" alt="Imagen por defecto">
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
      <p>
        La Escuela Provincial de Educación Técnica Nº 20 de Neuquén es un establecimiento de formación técnica de vanguardia, con modernas instalaciones, talleres y laboratorios, dedicado a formar Técnicos en Programación capaces de diseñar, desarrollar y gestionar soluciones informáticas, con compromiso social, capacidades analíticas, creativas y éticas.
      </p>
    </div>
    <div class="cards" aria-live="polite">
     <div class="block">
       <article class="card" role="region" aria-labelledby="misionTitle">
        <h3 id="misionTitle">Misión</h3>
        <p>
            Formar profesionales técnicos en programación que integren conocimientos científicos, metodológicos y tecnológicos, desarrollando habilidades prácticas y pensamiento crítico, para resolver problemas reales, innovar y contribuir al desarrollo productivo y social de la comunidad de Neuquén y del país.
        </p>
        </article>
      </div>
      <div class="block">
        <article class="card" role="region" aria-labelledby="visionTitle">
          <h3 id="visionTitle">Visión</h3>
          <p>
            Ser reconocida como una institución educativa líder en tecnología y programación, que inspire excelencia, innovación y adaptabilidad, formando técnicos competentes, comprometidos con los valores éticos y ciudadanos, preparados para afrontar los desafíos del presente y futuro digital.
          </p>
        </article>
      </div>
      <div class="block">
        <article class="card" role="region" aria-labelledby="valoresTitle">
        <h3 id="valoresTitle">Valores</h3>
        <p>
          <ul>
            <li>Responsabilidad: comprometernos con nuestros deberes académicos, profesionales y sociales.</li>
            <li>Innovación: incentivar la creatividad, el aprendizaje continuo y la adopción de nuevas tecnologías.</li>
            <li>Trabajo en equipo: colaborar entre alumnos, docentes y comunidad para lograr objetivos comunes.</li>
            <li>Respeto: hacia los otros, hacia las normas, la diversidad y el entorno físico y digital.</li>
            <li>Ética e integridad: actuar con honestidad, transparencia y coherencia en todas las acciones.</li>
          </ul>
        </p>
      </article>
      </div> 
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
          <div class="small">
            <a class="enlace" href="tel:+5492994478052">(299) 447-8052 </a></div>
        </div>
        <div>
          <strong>Email</strong>
          <div class="small">
            <a class="enlace" href="mailto:epet020@neuquen.edu.ar">epet020@neuquen.edu.ar</a>
          </div>
        </div>
      </div>
      <div class="small" style="margin-top:1rem;">© <?= date('Y') ?> E.P.E.T Nº 20 — Todos los derechos reservados</div>
    </div>
  </footer>

  <!--Fin footer-->

  <script src="js/carrusel.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  <script src="js/login.js"></script>
  
</html>
