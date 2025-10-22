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
