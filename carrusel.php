<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Carrusel Responsive Centrado</title>
  <link rel="stylesheet" href="css/carrusel.css">
  </head>
<body>

  <section class="carousel" aria-label="Carrusel de imágenes">
    <div class="slides" id="slides">
      <!-- Slide 1 -->
      <article class="slide">
        <picture>
          <source media="(min-width:1024px)" srcset="https://images.unsplash.com/photo-1503264116251-35a269479413?q=80&w=2000&auto=format&fit=crop">
          <img src="https://images.unsplash.com/photo-1503264116251-35a269479413?q=80&w=1000&auto=format&fit=crop" alt="Montañas al atardecer">
        </picture>
        <div class="slide__content">
          <h3 class="slide__title">Atardecer en las montañas</h3>
          <p class="slide__desc">La calma de la naturaleza en su máximo esplendor.</p>
        </div>
      </article>

      <!-- Slide 2 -->
      <article class="slide">
        <picture>
          <source media="(min-width:1024px)" srcset="https://images.unsplash.com/photo-1491553895911-0055eca6402d?q=80&w=2000&auto=format&fit=crop">
          <img src="https://images.unsplash.com/photo-1491553895911-0055eca6402d?q=80&w=1000&auto=format&fit=crop" alt="Luces de la ciudad">
        </picture>
        <div class="slide__content">
          <h3 class="slide__title">Luces de la ciudad</h3>
          <p class="slide__desc">El ritmo urbano que nunca se detiene.</p>
        </div>
      </article>

      <!-- Slide 3 -->
      <article class="slide">
        <picture>
          <source media="(min-width:1024px)" srcset="https://images.unsplash.com/photo-1501785888041-af3ef285b470?q=80&w=2000&auto=format&fit=crop">
          <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?q=80&w=1000&auto=format&fit=crop" alt="Playa y olas">
        </picture>
        <div class="slide__content">
          <h3 class="slide__title">Brisa marina</h3>
          <p class="slide__desc">El sonido del mar como banda sonora de tus días.</p>
        </div>
      </article>

      <!-- Slide 4 -->
      <article class="slide">
        <picture>
          <source media="(min-width:1024px)" srcset="https://images.unsplash.com/photo-1519681393784-d120267933ba?q=80&w=2000&auto=format&fit=crop">
          <img src="https://images.unsplash.com/photo-1519681393784-d120267933ba?q=80&w=1000&auto=format&fit=crop" alt="Bosque entre nieblas">
        </picture>
        <div class="slide__content">
          <h3 class="slide__title">Bosque entre nieblas</h3>
          <p class="slide__desc">Explora la magia escondida en cada sendero.</p>
        </div>
      </article>

      <!-- Slide 5 -->
      <article class="slide">
        <picture>
          <source media="(min-width:1024px)" srcset="https://images.unsplash.com/photo-1469474968028-56623f02e42e?q=80&w=2000&auto=format&fit=crop">
          <img src="https://images.unsplash.com/photo-1469474968028-56623f02e42e?q=80&w=1000&auto=format&fit=crop" alt="Camino rural">
        </picture>
        <div class="slide__content">
          <h3 class="slide__title">Camino rural</h3>
          <p class="slide__desc">El placer de avanzar sin prisa, rodeado de verde.</p>
        </div>
      </article>
    </div>

    <!-- Flechas -->
    <button class="carousel__arrow carousel__arrow--prev" id="prev">&#9664;</button>
    <button class="carousel__arrow carousel__arrow--next" id="next">&#9654;</button>

    <!-- Dots -->
    <div class="carousel__dots" id="dots"></div>
  </section>

  <script>
  (function(){
    const slidesEl = document.getElementById('slides');
    const slides = Array.from(slidesEl.children);
    const prevBtn = document.getElementById('prev');
    const nextBtn = document.getElementById('next');
    const dotsEl = document.getElementById('dots');
    let index = 0;
    const total = slides.length;
    const autoplayDelay = 4500;
    let autoplayTimer;

    // crear puntos
    slides.forEach((_, i) => {
      const dot = document.createElement('button');
      dot.className = 'dot';
      dot.setAttribute('data-index', i);
      dotsEl.appendChild(dot);
    });
    const dots = Array.from(dotsEl.children);

    function updateUI(){
      slidesEl.style.transform = `translateX(-${index * 100}%)`;
      dots.forEach((d,i)=>d.classList.toggle('active', i===index));
    }

    function showNext(){ index = (index + 1) % total; updateUI(); }
    function showPrev(){ index = (index - 1 + total) % total; updateUI(); }

    nextBtn.onclick = () => { showNext(); resetAutoplay(); };
    prevBtn.onclick = () => { showPrev(); resetAutoplay(); };
    dots.forEach(dot => dot.onclick = e => {
      index = Number(e.target.dataset.index);
      updateUI();
      resetAutoplay();
    });

    function startAutoplay(){
      autoplayTimer = setInterval(showNext, autoplayDelay);
    }
    function resetAutoplay(){
      clearInterval(autoplayTimer);
      startAutoplay();
    }

    slidesEl.addEventListener('mouseenter', ()=>clearInterval(autoplayTimer));
    slidesEl.addEventListener('mouseleave', startAutoplay);

    updateUI();
    startAutoplay();
  })();
  </script>
</body>
</html>
