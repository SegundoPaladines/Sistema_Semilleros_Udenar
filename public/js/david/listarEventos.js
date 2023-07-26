var eventoId;
function mostrarModalEliminar(id) {
    var modal = document.getElementById('delete_ext_emergente');
    modal.classList.add('show');
    modal.style.display = 'block';
    eventoId = id;
}

function cancerlarEliminarEvento() {
  var modal = document.getElementById('delete_ext_emergente');
    modal.style.display = 'none';
}
function confirmarEliminarEvento(){
    window.location.href = 'eliminar_evento/' + eventoId;
}