function porfavorActualizar() {
    var modalExito = document.getElementById('reg_ext_emergente');
    var modalTitulo = document.getElementById('modal-titulo');
    var modalMensaje = document.getElementById('modalExitoMensaje');
    var modalIcono = document.getElementById('modal-icono');
    var btnCerrarModal = document.getElementById('btnCerrarModal');
    var btnCerrarModal2 = document.getElementById('cerrar-modal');

    if (modalExito) {
      modalTitulo.textContent = 'Actualizar Datos Personales';
      modalMensaje.textContent = '¡Debe Actualizar Sus Datos Personales!';
      modalIcono.className = 'fas fa-exclamation-triangle text-warning modal-icono';
      btnCerrarModal.className = 'btn btn-warning';
    
      modalExito.classList.add('show');
      modalExito.style.display = 'block';
    
      btnCerrarModal.addEventListener('click', function() {
        modalExito.style.display = 'none';
      });

      btnCerrarModal2.addEventListener('click', function() {
        modalExito.style.display = 'none';
      });
    }
}
  
function actualizacionExitosa() {
    var modalExito = document.getElementById('reg_ext_emergente');
    var modalTitulo = document.getElementById('modal-titulo');
    var modalMensaje = document.getElementById('modalExitoMensaje');
    var modalIcono = document.getElementById('modal-icono');
    var btnCerrarModal = document.getElementById('btnCerrarModal');
    var btnCerrarModal2 = document.getElementById('cerrar-modal');
  
    if (modalExito) {
      modalTitulo.textContent = '¡Actualización Exitosa!';
      modalMensaje.textContent = 'Sus datos se actualizaron con Exito';
      modalIcono.className = 'fas fa-check-circle text-success modal-icono';
      btnCerrarModal.className = 'btn btn-success';
    
      modalExito.classList.add('show');
      modalExito.style.display = 'block';
    
      btnCerrarModal.addEventListener('click', function() {
        window.location.href = '/perfil';
      });

      btnCerrarModal2.addEventListener('click', function() {
        window.location.href = '/perfil';
      });

    }
}