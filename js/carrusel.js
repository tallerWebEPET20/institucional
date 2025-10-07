/* Carrusel */
  (function(){
    const carousel = document.getElementById('carousel');
    const slidesEl = document.getElementById('slides');
    const prevBtn = document.getElementById('prev');
    const nextBtn = document.getElementById('next');
    const dotsEl = document.getElementById('dots');
    let slides=[], dots=[], index=0, total=0, autoplayTimer=null, autoplayDelay=4500;

    function init(){
      slides = Array.from(slidesEl.querySelectorAll('.slide'));
      total = slides.length;
      dotsEl.innerHTML = '';
      if(total<=1){prevBtn.style.display='none';nextBtn.style.display='none';dotsEl.style.display='none'; return;}
      slides.forEach((s,i)=>{s.dataset.index=i; s.setAttribute('aria-hidden',i===0?'false':'true');});
      slides.forEach((_,i)=>{
        const d=document.createElement('button'); d.className='dot'; d.dataset.index=i; d.type='button'; d.setAttribute('aria-label',`Ir al slide ${i+1}`);
        d.addEventListener('click',()=>{index=i; update(); reset();});
        dotsEl.appendChild(d);
      });
      dots=Array.from(dotsEl.children);
      update(); start();
    }

    function update(){
      slidesEl.style.transform=`translateX(-${index*100}%)`;
      dots.forEach((d,i)=>d.classList.toggle('active',i===index));
      slides.forEach((s,i)=>s.setAttribute('aria-hidden',i===index?'false':'true'));
    }

    function next(){ index=(index+1)%total; update();}
    function prev(){ index=(index-1+total)%total; update();}
    function start(){autoplayTimer=setInterval(next,autoplayDelay);}
    function stop(){clearInterval(autoplayTimer);}
    function reset(){stop(); start();}

    nextBtn.addEventListener('click',()=>{next(); reset();});
    prevBtn.addEventListener('click',()=>{prev(); reset();});
    carousel.addEventListener('mouseenter',stop);
    carousel.addEventListener('mouseleave',start);
    window.addEventListener('keydown',(e)=>{if(e.key==='ArrowLeft') prev(); if(e.key==='ArrowRight') next();});
    init();
  })();

  /* Scroll reveal main/footer */
  (function(){
    const main=document.getElementById('mainInfo');
    const footer=document.getElementById('siteFooter');
    if(!('IntersectionObserver' in window)){main.classList.add('visible');footer.classList.add('visible');return;}
    const io=new IntersectionObserver((entries)=>{
      entries.forEach(entry=>{
        if(entry.target.id==='mainInfo' && entry.isIntersecting) entry.target.classList.add('visible');
        if(entry.target.id==='siteFooter' && entry.isIntersecting) entry.target.classList.add('visible');
      });
    },{root:null, rootMargin:'0px 0px -10% 0px', threshold:0.12});
    io.observe(main); io.observe(footer);
  })();