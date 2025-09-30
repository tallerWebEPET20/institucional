 $(window).scroll(function(){
        if($("#menu").offset().top > 58){
          $("#menu").removeClass("bg-transparente");
        }else{
          $("#menu").addClass("bg-transparente");
        }
      });

      $(window).scroll(function(){
        if($("#menu-2").offset().top > 58){
          $("#menu-2").removeClass("actived-2");
        }else{
          $("#menu-2").addClass("actived-2");
        }
      });

      $(window).scroll(function(){
        if($(".menu-3").offset().top > 58){
          $(".menu-3").removeClass("n-color-2");
        }else{
          $(".menu-3").addClass("n-color-2");
        }
      });


      // Efectos de menú (conservados del original si existen los IDs/clases)
    $(window).on('scroll', function(){
      if ($('#menu').length && $('#menu').offset().top > 58) { $('#menu').removeClass('bg-transparente'); } else { $('#menu').addClass('bg-transparente'); }
      if ($('#menu-2').length && $('#menu-2').offset().top > 58) { $('#menu-2').removeClass('actived-2'); } else { $('#menu-2').addClass('actived-2'); }
      if ($('.menu-3').length && $('.menu-3').offset().top > 58) { $('.menu-3').removeClass('n-color-2'); } else { $('.menu-3').addClass('n-color-2'); }
    });