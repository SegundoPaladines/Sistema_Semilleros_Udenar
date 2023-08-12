var proyectosId;
function mostrarModalEliminar(id) {
    var modal = document.getElementById('delete_ext_emergente');
    modal.classList.add('show');
    modal.style.display = 'block';
    proyectosId = id;
}

function cancerlarEliminarProyecto() {
  var modal = document.getElementById('delete_ext_emergente');
    modal.style.display = 'none';
}
function confirmarEliminarProyecto(){
    window.location.href = 'eliminar_proyecto/' + proyectosId;
}