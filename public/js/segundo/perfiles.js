function actualizacionExitosa(id) {
    var modalExito = document.getElementById('reg_ext_emergente');
    var modalTitulo = document.getElementById('modal-titulo');
    var modalMensaje = document.getElementById('modalExitoMensaje');
    var modalIcono = document.getElementById('modal-icono');
    var btnCerrarModal = document.getElementById('btnCerrarModal');
    var btnCerrarModal2 = document.getElementById('cerrar-modal');
  
    if (modalExito) {
      modalTitulo.textContent = '¡Actualización Exitosa!';
      modalMensaje.textContent = 'Los datos se actualizaron con Exito';
      modalIcono.className = 'fas fa-check-circle text-success modal-icono';
      btnCerrarModal.className = 'btn btn-success';
    
      modalExito.classList.add('show');
      modalExito.style.display = 'block';
    
      btnCerrarModal.addEventListener('click', function() {
        window.location.href = '/admin/perfil/'+id;
      });

      btnCerrarModal2.addEventListener('click', function() {
        window.location.href = '/admin/perfil/'+id;
      });
    }
  }