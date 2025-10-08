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
    
  </head>
  <body onload="mostrarMensaje()">

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
      <h2 id="mainTitle">Instituto de Educación Técnica Nº 20</h2>
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
        <div><strong>Dirección</strong><div class="small">Av. Ejemplo 123, Ciudad</div></div>
        <div><strong>Teléfono</strong><div class="small">+54 9 11 1234 5678</div></div>
        <div><strong>Email</strong><div class="small"><a href="mailto:info@instituto.edu">info@instituto.edu</a></div></div>
      </div>
      <div class="small" style="margin-top:1rem;">© <?= date('Y') ?> Instituto de Educación Técnica Nº 20 — Todos los derechos reservados</div>
    </div>
  </footer>

  <script src="js/carrusel.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>
