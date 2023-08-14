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
//Filtro buscar usuarios
const searchInput = document.getElementById('buscador');
const cards = document.querySelectorAll('.card-container .card');

searchInput.addEventListener('input', filterCards);

function filterCards() {
    const searchTerm = searchInput.value.toLowerCase();

    cards.forEach(card => {
        const name = card.querySelector('.card-text').textContent.toLowerCase();
        const role = card.querySelector('.badge').textContent.toLowerCase();
        const email = card.querySelector('.text-muted').textContent.toLowerCase();

        if (name.includes(searchTerm) || role.includes(searchTerm) || email.includes(searchTerm)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

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

