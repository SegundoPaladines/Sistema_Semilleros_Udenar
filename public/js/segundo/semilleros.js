var semilleroId;
function mostrarModalEliminar(id) {
    var modal = document.getElementById('delete_ext_emergente');
    modal.classList.add('show');
    modal.style.display = 'block';
    semilleroId = id;
}

function cancerlarEliminar() {
  var modal = document.getElementById('delete_ext_emergente');
    modal.style.display = 'none';
}
function confirmarEliminar(){
    window.location.href = 'eliminar-semillero/' + semilleroId;
}

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

        if (aceptacion) {
            modalIcono.classList.add('fas', 'fa-check-circle', 'text-success', 'modal-icono-aceptacion', 'fa-5x');
            modalExito.classList.add('modal-aceptacion');
            btnCerrarModal1.classList.add('btn-success');
        } else {
            modalIcono.classList.add('fas', 'fa-times-circle', 'text-danger', 'modal-icono-rechazo', 'fa-5x');
            modalExito.classList.add('modal-rechazo');
            btnCerrarModal1.classList.add('btn-danger');
        }

        modalExito.classList.add('show');
        modalExito.style.display = 'block';

        btnCerrarModal1.addEventListener('click', function() {
            modalExito.style.display = 'none';
        });

        btnCerrarModal2.addEventListener('click', function() {
            modalExito.style.display = 'none';
        });

    }
}