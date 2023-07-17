function mostrarAlertaRegistroExitoso(mensaje, titulo, aceptacion) {
    var modalExito = document.getElementById('reg_ext_emergente');
    var modalTitulo = document.getElementById('modal-titulo');
    var modalMensaje = document.getElementById('modalExitoMensaje');
    var modalIcono = document.getElementById('modal-icono');
    var btnCerrarModal1 = document.getElementById('btnCerrarModal');
    var btnCerrarModal2 = document.getElementById('cerrar-modal'); 

    if (modalExito) {
      modalTitulo.textContent = titulo;
      modalMensaje.textContent = mensaje;

      modalIcono.classList.add('fas', 'fa-check-circle', 'text-success', 'modal-icono-aceptacion', 'fa-5x');
      modalExito.classList.add('modal-aceptacion');
      btnCerrarModal1.classList.add('btn', 'btn-success');

      modalExito.classList.add('show');
      modalExito.style.display = 'block';

      btnCerrarModal1.addEventListener('click', function() {
        window.location.href = 'home';
      });

      btnCerrarModal2.addEventListener('click', function() {
        window.location.href = 'home';
      });
    }
  }