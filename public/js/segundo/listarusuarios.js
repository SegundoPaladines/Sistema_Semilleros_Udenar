const spans = document.querySelectorAll('span[id^="rol_"]');

spans.forEach((span) => {

    const valor = span.textContent.trim();
  
    if (valor === 'admin') {
      span.classList.add('badge-success');
    } else if (valor === 'coordinador') {
      span.classList.add('badge-primary');
    } else if (valor === 'semillerista') {
      span.classList.add('badge-warning');
    }
});

const searchInput = document.querySelector('#buscador');
const rows = document.querySelectorAll('#tabla_usuarios tbody tr');

searchInput.addEventListener('input', function () {
    const searchTerm = this.value.trim().toLowerCase();

    rows.forEach(row => {
        const id = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
        const name = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
        const email = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
        const rol = row.querySelector('td:nth-child(5)').textContent.toLowerCase();

        if (name.includes(searchTerm) || email.includes(searchTerm) || id.includes(searchTerm) || rol.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

var usuarioId;
function mostrarModalEliminar(id) {
    var modal = document.getElementById('delete_ext_emergente');
    modal.classList.add('show');
    modal.style.display = 'block';
    usuarioId = id;
}

function cancerlarEliminarUsuario() {
  var modal = document.getElementById('delete_ext_emergente');
    modal.style.display = 'none';
}
function confirmarEliminarUsuario(){
    window.location.href = 'eliminar-usuario/' + usuarioId;
}