const searchInput = document.querySelector('#buscador');
const rows = document.querySelectorAll('#tabla_semilleros tbody tr');

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